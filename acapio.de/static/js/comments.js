(function() {
    var section = document.getElementById('comment-section');
    if (!section) return;

    var COMMENTS_API_URL = section.getAttribute('data-api-url');
    var COMMENTS_API_KEY = section.getAttribute('data-api-key');
    var postId = document.getElementById('post_id').value;

    loadComments();

    document.getElementById('comment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        submitComment();
    });

    window.replyTo = replyTo;
    window.cancelReply = cancelReply;

    function loadComments() {
        var url = COMMENTS_API_URL + '?post_id=' + encodeURIComponent(postId) + '&api_key=' + encodeURIComponent(COMMENTS_API_KEY);

        fetch(url)
            .then(function(response) { return response.json(); })
            .then(function(data) { renderComments(data); })
            .catch(function() {
                document.getElementById('comments-list').innerHTML =
                    '<p class="no-comments">Kommentare konnten nicht geladen werden.</p>';
            });
    }

    function renderComments(comments) {
        var container = document.getElementById('comments-list');
        if (!comments || comments.length === 0) {
            container.innerHTML = '<p class="no-comments">Noch keine Kommentare. Sei der Erste!</p>';
            return;
        }
        container.innerHTML = comments.map(function(c) { return renderComment(c); }).join('');
    }

    function renderComment(comment) {
        var date = new Date(comment.created_at);
        var formattedDate = date.toLocaleDateString('de-DE', {
            day: '2-digit', month: '2-digit', year: 'numeric'
        }) + ' ' + date.toLocaleTimeString('de-DE', {
            hour: '2-digit', minute: '2-digit'
        });

        var isAdmin   = comment.is_admin_reply == 1 || comment.is_admin_reply === true;
        var adminClass  = isAdmin ? 'admin-reply' : '';
        var authorClass = isAdmin ? ' is-admin' : '';

        // Author: link to homepage if provided
        var authorHtml;
        if (comment.homepage) {
            authorHtml = '<a href="' + escapeHtml(comment.homepage) + '" target="_blank" rel="noopener noreferrer">'
                       + escapeHtml(comment.name) + '</a>';
        } else {
            authorHtml = escapeHtml(comment.name);
        }

        var repliesHtml = '';
        if (comment.replies && comment.replies.length > 0) {
            repliesHtml = '<div class="comment-replies">'
                + comment.replies.map(function(r) { return renderComment(r); }).join('')
                + '</div>';
        }

        return '<div class="comment-item ' + adminClass + '" data-id="' + comment.id + '">'
             +   '<div class="comment-header">'
             +     '<span class="comment-author' + authorClass + '">' + authorHtml + '</span>'
             +     '<span class="comment-date">' + formattedDate + '</span>'
             +   '</div>'
             +   '<div class="comment-text">' + escapeHtml(comment.comment) + '</div>'
             +   '<button class="reply-btn" onclick="replyTo(' + comment.id + ', \'' + escapeHtml(comment.name) + '\')">'
             +     '&#x1F4AC; Antworten'
             +   '</button>'
             +   repliesHtml
             + '</div>';
    }

    function replyTo(commentId, authorName) {
        document.getElementById('parent_id').value = commentId;
        document.getElementById('reply-indicator').style.display = 'flex';
        document.getElementById('reply-to-name').textContent = authorName;
        document.getElementById('comment').focus();
        document.getElementById('comment-form').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function cancelReply() {
        document.getElementById('parent_id').value = '';
        document.getElementById('reply-indicator').style.display = 'none';
    }

    function submitComment() {
        var form      = document.getElementById('comment-form');
        var submitBtn = document.getElementById('submit-btn');
        var messageEl = document.getElementById('form-message');

        submitBtn.disabled = true;
        submitBtn.textContent = 'Wird gesendet...';
        messageEl.className = 'form-message';
        messageEl.style.display = 'none';

        fetch(COMMENTS_API_URL, {
            method: 'POST',
            headers: { 'X-API-Key': COMMENTS_API_KEY },
            body: new FormData(form)
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                messageEl.textContent = data.message || 'Kommentar erfolgreich gesendet!';
                messageEl.className = 'form-message success';
                messageEl.style.display = 'block';
                form.reset();
                document.getElementById('post_id').value = postId;
                cancelReply();
                loadComments();
            } else {
                messageEl.textContent = data.message || 'Fehler beim Senden des Kommentars.';
                messageEl.className = 'form-message error';
                messageEl.style.display = 'block';
            }
        })
        .catch(function() {
            messageEl.textContent = 'Verbindungsfehler. Bitte versuche es erneut.';
            messageEl.className = 'form-message error';
            messageEl.style.display = 'block';
        })
        .finally(function() {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Absenden';
        });
    }

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
})();
