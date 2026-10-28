<?php
/**
 * Add New Scam
 * acapio.de Scam Database
 */

$pageTitle = 'Neuer Scam';
$pageIcon = '➕';
require_once '../includes/admin-header.php';

$success = false;
$error = '';

// Get categories for dropdown
$categories = getCategories();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate required fields
        if (empty($_POST['scam_type']) || empty($_POST['message_content'])) {
            throw new Exception('Scam-Typ und Nachricht sind erforderlich.');
        }
        
        $pdo = getDbConnection();
        $pdo->beginTransaction();
        
        // Insert main scam record
        $sql = "INSERT INTO scams (scam_type, message_content, language, date_received, notes, status) 
                VALUES (:scam_type, :message_content, :language, :date_received, :notes, :status)";
        
        executeQuery($sql, [
            ':scam_type' => $_POST['scam_type'],
            ':message_content' => $_POST['message_content'],
            ':language' => $_POST['language'] ?? 'de',
            ':date_received' => !empty($_POST['date_received']) ? $_POST['date_received'] : null,
            ':notes' => $_POST['notes'] ?? null,
            ':status' => $_POST['status'] ?? 'approved'
        ]);
        
        $scam_id = getLastInsertId();
        
        // Insert email addresses
        if (!empty($_POST['emails'])) {
            $emails = parseMultilineInput($_POST['emails']);
            foreach ($emails as $email) {
                if (isValidEmail($email)) {
                    executeQuery("INSERT INTO scam_emails (scam_id, email_address) VALUES (:scam_id, :email)", [
                        ':scam_id' => $scam_id,
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
                    ':scam_id' => $scam_id,
                    ':name' => $name
                ]);
            }
        }
        
        // Insert phone numbers
        if (!empty($_POST['phone_numbers'])) {
            $phones = parseMultilineInput($_POST['phone_numbers']);
            foreach ($phones as $phone) {
                executeQuery("INSERT INTO scam_phone_numbers (scam_id, phone_number) VALUES (:scam_id, :phone)", [
                    ':scam_id' => $scam_id,
                    ':phone' => $phone
                ]);
            }
        }
        
        // Insert categories
        if (!empty($_POST['categories']) && is_array($_POST['categories'])) {
            foreach ($_POST['categories'] as $cat_id) {
                executeQuery("INSERT INTO scam_category_link (scam_id, category_id) VALUES (:scam_id, :cat_id)", [
                    ':scam_id' => $scam_id,
                    ':cat_id' => $cat_id
                ]);
            }
        }
        
        $pdo->commit();
        $success = true;
        
        // Clear form data on success
        $_POST = [];
        
    } catch (Exception $e) {
        if (isset($pdo)) {
            $pdo->rollBack();
        }
        $error = $e->getMessage();
    }
}
?>

<a href="index.php" class="back-link">← Zurück zum Dashboard</a>

<div class="form-container">
    <?php if ($success): ?>
    <div class="alert alert-success">
        ✅ Scam erfolgreich hinzugefügt! <a href="index.php">Zurück zum Dashboard</a>
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
                <option value="de" <?php echo (!isset($_POST['language']) || $_POST['language'] === 'de') ? 'selected' : ''; ?>>Deutsch</option>
                <option value="en" <?php echo (isset($_POST['language']) && $_POST['language'] === 'en') ? 'selected' : ''; ?>>Englisch</option>
                <option value="fr" <?php echo (isset($_POST['language']) && $_POST['language'] === 'fr') ? 'selected' : ''; ?>>Französisch</option>
                <option value="es" <?php echo (isset($_POST['language']) && $_POST['language'] === 'es') ? 'selected' : ''; ?>>Spanisch</option>
                <option value="other" <?php echo (isset($_POST['language']) && $_POST['language'] === 'other') ? 'selected' : ''; ?>>Andere</option>
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
                <option value="approved" <?php echo (!isset($_POST['status']) || $_POST['status'] === 'approved') ? 'selected' : ''; ?>>Genehmigt</option>
                <option value="pending" <?php echo (isset($_POST['status']) && $_POST['status'] === 'pending') ? 'selected' : ''; ?>>Ausstehend</option>
                <option value="rejected" <?php echo (isset($_POST['status']) && $_POST['status'] === 'rejected') ? 'selected' : ''; ?>>Abgelehnt</option>
            </select>
        </div>

        <div class="form-group">
            <label for="notes">Notizen</label>
            <textarea id="notes" name="notes" 
                      placeholder="Optionale interne Notizen..."><?php echo h($_POST['notes'] ?? ''); ?></textarea>
            <div class="help-text">Interne Notizen (nicht öffentlich sichtbar)</div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">💾 Scam speichern</button>
            <a href="index.php" class="btn btn-secondary">Abbrechen</a>
        </div>
    </form>
</div>

<?php require_once '../includes/admin-footer.php'; ?>