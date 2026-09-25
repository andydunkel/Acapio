const pagefindBundleUrl = {{ "pagefind/pagefind.js" | relURL | jsonify | safeJS }};
const labels = {
  error: "Die Suche konnte nicht geladen werden.",
  noMatches: {{ T "no_matches" | jsonify | safeJS }},
  quickLinks: {{ T "quick_links" | jsonify | safeJS }},
  shortQuery: {{ T "short_search_query" | jsonify | safeJS }},
  typeToSearch: {{ T "type_to_search" | jsonify | safeJS }}
};

let pagefindPromise;

function loadPagefind() {
  if (!pagefindPromise) {
    pagefindPromise = import(pagefindBundleUrl).then(async (pagefind) => {
      await pagefind.init();
      return pagefind;
    });
  }

  return pagefindPromise;
}

function minimumQueryLength(query) {
  return Number.isFinite(Number(query)) ? 1 : 2;
}

function showMessage(container, message) {
  container.replaceChildren();

  const messageElement = document.createElement('span');
  messageElement.className = 'search_result';
  messageElement.textContent = message;
  container.appendChild(messageElement);
}

function renderResults(container, results) {
  container.replaceChildren();

  if (!results.length) {
    showMessage(container, labels.noMatches);
    return;
  }

  const fragment = document.createDocumentFragment();
  const title = document.createElement('h3');
  title.className = 'search_title';
  title.textContent = labels.quickLinks;
  fragment.appendChild(title);

  for (const result of results) {
    const link = document.createElement('a');
    link.className = 'search_result';
    link.href = result.url;
    link.textContent = result.meta?.title || result.url;
    fragment.appendChild(link);
  }

  container.appendChild(fragment);
}

function initializeSearch(searchRoot) {
  const field = searchRoot.querySelector('.search_field');
  const resultsContainer = searchRoot.querySelector('.search_results');

  if (!field || !resultsContainer) {
    return;
  }

  resultsContainer.setAttribute('aria-live', 'polite');
  resultsContainer.setAttribute('aria-busy', 'false');

  let debounceTimer;
  let searchSequence = 0;

  field.addEventListener('focus', () => {
    loadPagefind().catch((error) => console.error('Pagefind konnte nicht geladen werden.', error));
  }, { once: true });

  field.addEventListener('input', () => {
    const query = field.value.trim();
    const currentSequence = ++searchSequence;
    window.clearTimeout(debounceTimer);
    resultsContainer.setAttribute('aria-busy', 'false');

    if (!query) {
      resultsContainer.replaceChildren();
      return;
    }

    if (query.length < minimumQueryLength(query)) {
      showMessage(resultsContainer, query.length > 1 ? labels.shortQuery : labels.typeToSearch);
      return;
    }

    debounceTimer = window.setTimeout(async () => {
      resultsContainer.setAttribute('aria-busy', 'true');

      try {
        const pagefind = await loadPagefind();
        const search = await pagefind.search(query);
        const resultData = await Promise.all(
          search.results.slice(0, 8).map((result) => result.data())
        );

        if (currentSequence === searchSequence) {
          renderResults(resultsContainer, resultData);
        }
      } catch (error) {
        console.error('Pagefind-Suche fehlgeschlagen.', error);
        pagefindPromise = undefined;

        if (currentSequence === searchSequence) {
          showMessage(resultsContainer, labels.error);
        }
      } finally {
        if (currentSequence === searchSequence) {
          resultsContainer.setAttribute('aria-busy', 'false');
        }
      }
    }, 250);
  });

  field.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      field.value = '';
      searchSequence += 1;
      window.clearTimeout(debounceTimer);
      resultsContainer.setAttribute('aria-busy', 'false');
      resultsContainer.replaceChildren();
      field.blur();
    }
  });

  document.addEventListener('click', (event) => {
    if (!searchRoot.contains(event.target)) {
      resultsContainer.replaceChildren();
    }
  });
}

document.querySelectorAll('.search').forEach(initializeSearch);
