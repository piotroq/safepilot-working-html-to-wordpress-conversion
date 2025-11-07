# Security Policy

## Supported Versions

We release patches for security vulnerabilities. Currently, the following versions are supported:

| Version | Supported          |
| ------- | ------------------ |
| 1.0.x   | :white_check_mark: |

## Reporting a Vulnerability

We take the security of SafePilot WordPress Theme seriously. If you believe you have found a security vulnerability, please report it to us as described below.

### Please do NOT:

- Open a public GitHub issue
- Publicly disclose the vulnerability before it has been addressed

### Please DO:

1. Email your findings to: security@safepilot.pl
2. Provide as much information as possible about the vulnerability:
   - Type of vulnerability
   - Steps to reproduce
   - Potential impact
   - Suggested fix (if any)

### What to expect:

- We will acknowledge receipt of your vulnerability report within 48 hours
- We will send you regular updates about our progress
- We will notify you when the vulnerability is fixed
- We may ask for additional information or guidance

## Security Best Practices

### For Users

1. **Keep WordPress Updated**: Always use the latest version of WordPress
2. **Update PHP**: Use PHP 8.2 or newer
3. **Strong Passwords**: Use strong, unique passwords for admin accounts
4. **Two-Factor Authentication**: Enable 2FA on admin accounts
5. **Regular Backups**: Maintain regular backups of your site
6. **SSL Certificate**: Always use HTTPS
7. **File Permissions**: Set correct file permissions (644 for files, 755 for directories)
8. **Disable File Editing**: Add `define('DISALLOW_FILE_EDIT', true);` to wp-config.php

### For Developers

1. **Input Sanitization**: All user inputs are sanitized using WordPress functions
   - `sanitize_text_field()` for text
   - `sanitize_email()` for emails
   - `esc_url_raw()` for URLs
   - `wp_kses_post()` for HTML content

2. **Output Escaping**: All outputs are escaped
   - `esc_html()` for HTML
   - `esc_attr()` for attributes
   - `esc_url()` for URLs
   - `wp_kses_post()` for allowed HTML

3. **Nonce Verification**: All forms use WordPress nonces
   ```php
   wp_nonce_field( 'action_name', 'nonce_field_name' );
   wp_verify_nonce( $_POST['nonce_field_name'], 'action_name' );
   ```

4. **SQL Injection Prevention**: Use `$wpdb->prepare()` for all database queries
   ```php
   $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE ID = %d", $post_id );
   ```

5. **User Capability Checks**: Always check user capabilities
   ```php
   if ( ! current_user_can( 'edit_post', $post_id ) ) {
       return;
   }
   ```

6. **CSRF Protection**: All AJAX requests use nonces
   ```php
   wp_create_nonce( 'ajax_action_name' );
   check_ajax_referer( 'ajax_action_name' );
   ```

7. **XSS Prevention**: No use of `eval()`, minimize use of `innerHTML`
8. **File Upload Security**: Validate file types and sizes
9. **Direct File Access**: All PHP files check for `ABSPATH`
   ```php
   if ( ! defined( 'ABSPATH' ) ) {
       exit;
   }
   ```

## Known Security Features

### Implemented Security Measures

1. **Data Sanitization**
   - All custom fields are sanitized before saving
   - Admin settings use proper sanitization callbacks
   - Custom meta boxes validate and sanitize input

2. **Data Escaping**
   - All theme templates properly escape output
   - Admin pages escape all displayed data
   - JavaScript data is properly escaped

3. **Nonce Verification**
   - Meta box saves verify nonces
   - Admin forms use nonce fields
   - AJAX requests verify nonces

4. **Capability Checks**
   - Admin pages check `manage_options` capability
   - Meta box saves check `edit_post` capability
   - Custom post types have proper capability_type

5. **SQL Injection Prevention**
   - Use of WordPress data API
   - No direct SQL queries without preparation
   - Proper use of `$wpdb->prepare()`

6. **XSS Prevention**
   - Proper escaping of all output
   - Use of `wp_kses()` for HTML content
   - Sanitization of all attributes

7. **CSRF Protection**
   - WordPress nonces on all forms
   - AJAX nonce verification
   - Referrer checks where appropriate

8. **File Security**
   - No file uploads in theme
   - Proper file permission recommendations
   - No execution of user-supplied files

## Security Checklist

- [x] Input sanitization
- [x] Output escaping
- [x] Nonce verification
- [x] Capability checks
- [x] SQL injection prevention
- [x] XSS prevention
- [x] CSRF protection
- [x] Direct file access prevention
- [x] Secure coding standards
- [x] WordPress Coding Standards compliance

## Vulnerability Disclosure Timeline

1. **Day 0**: Vulnerability reported
2. **Day 1-2**: Acknowledgment sent to reporter
3. **Day 3-14**: Investigation and fix development
4. **Day 15-30**: Testing and verification
5. **Day 31**: Security patch released
6. **Day 32**: Public disclosure (coordinated with reporter)

## Security Updates

Security updates are released as soon as possible after a vulnerability is confirmed. We recommend:

1. Subscribe to our security mailing list
2. Watch the GitHub repository for releases
3. Enable automatic updates in WordPress

## Contact

For security concerns, please contact:
- **Email**: security@safepilot.pl
- **GitHub**: Open an issue (for general security questions only, not vulnerabilities)

## Credits

We would like to thank the following security researchers:

(List will be updated as vulnerabilities are reported and fixed)

---

Last updated: 2025-10-28
