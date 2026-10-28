<?php
/**
 * Edit Scam
 * acapio.de Scam Database
 */

// Include dependencies first
require_once '../config/database.php';
require_once '../includes/functions.php';

// Get scam ID
$scamId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($scamId <= 0) {
    header('Location: list-scams.php');
    exit;
}

$success = false;
$error = '';

// Load scam data
try {
    $scam = getScamById($scamId);
    if (!$scam) {
        header('Location: list-scams.php');
        exit;
    }
} catch (Exception $e) {
    die("Error loading scam: " . $e->getMessage());
}

// Get categories for dropdown
$categories = getCategories();

// Prepare current data for form
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_POST = [
        'scam_type' => $scam['scam_type'],
        'message_content' => $scam['message_content'],
        'language' => $scam['language'],
        'date_received' => $scam['date_received'],
        'status' => $scam['status'],
        'notes' => $scam['notes'],
        'emails' => implode("\n", array_column($scam['emails'], 'email_address')),
        'names' => implode("\n", array_column($scam['names'], 'name')),
        'phone_numbers' => implode("\n", array_column($scam['phones'], 'phone_number')),
        'categories' => array_column($scam['categories'], 'id')
    ];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate required fields
        if (empty($_POST['scam_type']) || empty($_POST['message_content'])) {
            throw new Exception('Scam-Typ und Nachricht sind erforderlich.');
        }
        
        $pdo = getDbConnection();
        $pdo->beginTransaction();
        
        // Update main scam record
        $sql = "UPDATE scams SET 
                scam_type = :scam_type,
                message_content = :message_content,
                language = :language,
                date_received = :date_received,
                notes = :notes,
                status = :status
                WHERE id = :id";
        
        executeQuery($sql, [
            ':scam_type' => $_POST['scam_type'],
            ':message_content' => $_POST['message_content'],
            ':language' => $_POST['language'] ?? 'de',
            ':date_received' => !empty($_POST['date_received']) ? $_POST['date_received'] : null,
            ':notes' => $_POST['notes'] ?? null,
            ':status' => $_POST['status'] ?? 'approved',
            ':id' => $scamId
        ]);
        
        // Delete existing related records
        executeQuery("DELETE FROM scam_emails WHERE scam_id = :id", [':id' => $scamId]);
        executeQuery("DELETE FROM scam_names WHERE scam_id = :id", [':id' => $scamId]);
        executeQuery("DELETE FROM scam_phone_numbers WHERE scam_id = :id", [':id' => $scamId]);
        executeQuery("DELETE FROM scam_category_link WHERE scam_id = :id", [':id' => $scamId]);
        
        // Insert email addresses
        if (!empty($_POST['emails'])) {
            $emails = parseMultilineInput($_POST['emails']);
            foreach ($emails as $email) {
                if (isValidEmail($email)) {
                    executeQuery("INSERT INTO scam_emails (scam_id, email_address) VALUES (:scam_id, :email)", [
                        ':scam_id' => $scamId,
                        ':email' => $email
                    ]);
                }
            }
        }
        
        // Insert names
        if (!empty($_POST['names'])) {
            $names = parseMultilineInput($_POST['names']);
            foreach ($names as $name) {
                executeQuery("INSERT INTO scam_names (scam_id, name) VALUES (:scam_id, :name)", [
                    ':scam_id' => $scamId,
                    ':name' => $name
                ]);
            }
        }
        
        // Insert phone numbers
        if (!empty($_POST['phone_numbers'])) {
            $phones = parseMultilineInput($_POST['phone_numbers']);
            foreach ($phones as $phone) {
                executeQuery("INSERT INTO scam_phone_numbers (scam_id, phone_number) VALUES (:scam_id, :phone)", [
                    ':scam_id' => $scamId,
                    ':phone' => $phone
                ]);
            }
        }
        
        // Insert categories
        if (!empty($_POST['categories']) && is_array($_POST['categories'])) {
            foreach ($_POST['categories'] as $cat_id) {
                executeQuery("INSERT INTO scam_category_link (scam_id, category_id) VALUES (:scam_id, :cat_id)", [
                    ':scam_id' => $scamId,
                    ':cat_id' => $cat_id
                ]);
            }
        }
        
        $pdo->commit();
        $success = true;
        
        // Reload scam data to show updated version
        $scam = getScamById($scamId);
        
    } catch (Exception $e) {
        if (isset($pdo)) {
            $pdo->rollBack();
        }
        $error = $e->getMessage();
    }
}

$pageTitle = 'Scam #' . $scamId . ' bearbeiten';
$pageIcon = '✏️';
require_once '../includes/admin-header.php';
?>

<a href="view-scam.php?id=<?php echo h($scamId); ?>" class="back-link">← Zurück zur Ansicht</a>

<div class="form-container">
    <?php if ($success): ?>
    <div class="alert alert-success">
        ✅ Scam erfolgreich aktualisiert! 
        <a href="view-scam.php?id=<?php echo h($scamId); ?>">Zurück zur Ansicht</a> | 
        <a href="list-scams.php">Zur Liste</a>
    </div>
    <?php endif; ?>

    <?php if ($error): ?>
    <div class="alert alert-error">
        ❌ Fehler: <?php echo h($error); ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="scam_type">Scam-Typ <span class="required">*</span></label>
            <input type="text" id="scam_type" name="scam_type" 
                   value="<?php echo h($_POST['scam_type'] ?? ''); ?>" 
                   placeholder="z.B. Erbschaftsbetrug, Lotteriegewinn, etc." required>
            <div class="help-text">Kurze Beschreibung des Scam-Typs</div>
        </div>

        <div class="form-group">
            <label for="message_content">Nachrichteninhalt <span class="required">*</span></label>
            <textarea id="message_content" name="message_content" required 
                      placeholder="Vollständiger Text der Scam-Nachricht..."><?php echo h($_POST['message_content'] ?? ''); ?></textarea>
            <div class="help-text">Kompletter Text der betrügerischen Nachricht</div>
        </div>

        <div class="form-group">
            <label for="emails">Email-Adressen</label>
            <textarea id="emails" name="emails" 
                      placeholder="eine@email.com&#10;weitere@email.de&#10;..."><?php echo h($_POST['emails'] ?? ''); ?></textarea>
            <div class="help-text">Eine Email-Adresse pro Zeile</div>
        </div>

        <div class="form-group">
            <label for="names">Namen</label>
            <textarea id="names" name="names" 
                      placeholder="Max Mustermann&#10;Dr. Hans Schmidt&#10;..."><?php echo h($_POST['names'] ?? ''); ?></textarea>
            <div class="help-text">Ein Name pro Zeile</div>
        </div>

        <div class="form-group">
            <label for="phone_numbers">Telefonnummern</label>
            <textarea id="phone_numbers" name="phone_numbers" 
                      placeholder="+49 123 456789&#10;0176 12345678&#10;..."><?php echo h($_POST['phone_numbers'] ?? ''); ?></textarea>
            <div class="help-text">Eine Telefonnummer pro Zeile</div>
        </div>

        <div class="form-group">
            <label>Kategorien</label>
            <div class="checkbox-group">
                <?php foreach ($categories as $cat): ?>
                <div class="checkbox-item">
                    <input type="checkbox" name="categories[]" value="<?php echo h($cat['id']); ?>" 
                           id="cat_<?php echo h($cat['id']); ?>"
                           <?php echo (isset($_POST['categories']) && in_array($cat['id'], $_POST['categories'])) ? 'checked' : ''; ?>>
                    <label for="cat_<?php echo h($cat['id']); ?>">
                        <?php echo h($cat['name']); ?>
                    </label>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="language">Sprache</label>
            <select id="language" name="language">
                <option value="de" <?php echo ($_POST['language'] === 'de') ? 'selected' : ''; ?>>Deutsch</option>
                <option value="en" <?php echo ($_POST['language'] === 'en') ? 'selected' : ''; ?>>Englisch</option>
                <option value="fr" <?php echo ($_POST['language'] === 'fr') ? 'selected' : ''; ?>>Französisch</option>
                <option value="es" <?php echo ($_POST['language'] === 'es') ? 'selected' : ''; ?>>Spanisch</option>
                <option value="other" <?php echo ($_POST['language'] === 'other') ? 'selected' : ''; ?>>Andere</option>
            </select>
        </div>

        <div class="form-group">
            <label for="date_received">Empfangsdatum</label>
            <input type="date" id="date_received" name="date_received" 
                   value="<?php echo h($_POST['date_received'] ?? ''); ?>">
            <div class="help-text">Wann wurde diese Nachricht empfangen?</div>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="approved" <?php echo ($_POST['status'] === 'approved') ? 'selected' : ''; ?>>Genehmigt</option>
                <option value="pending" <?php echo ($_POST['status'] === 'pending') ? 'selected' : ''; ?>>Ausstehend</option>
                <option value="rejected" <?php echo ($_POST['status'] === 'rejected') ? 'selected' : ''; ?>>Abgelehnt</option>
            </select>
        </div>

        <div class="form-group">
            <label for="notes">Notizen</label>
            <textarea id="notes" name="notes" 
                      placeholder="Optionale interne Notizen..."><?php echo h($_POST['notes'] ?? ''); ?></textarea>
            <div class="help-text">Interne Notizen (nicht öffentlich sichtbar)</div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">💾 Änderungen speichern</button>
            <a href="view-scam.php?id=<?php echo h($scamId); ?>" class="btn btn-secondary">Abbrechen</a>
        </div>
    </form>
</div>

<!-- Metadata Info -->
<div class="content-section" style="background: #f8f9fa; margin-top: 20px;">
    <h3 style="font-size: 14px; margin-bottom: 10px; color: #666;">ℹ️ Metadaten</h3>
    <div style="font-size: 13px; color: #666;">
        <div style="margin-bottom: 5px;">
            <strong>Erstellt:</strong> <?php echo formatDateTime($scam['created_at']); ?>
        </div>
        <div>
            <strong>Zuletzt geändert:</strong> <?php echo formatDateTime($scam['updated_at']); ?>
        </div>
    </div>
</div>

<?php require_once '../includes/admin-footer.php'; ?>