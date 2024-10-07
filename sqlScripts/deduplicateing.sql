INSERT INTO sh_leads (client_id, type, lead_id, status, sh_status, source, medium, keyword, lead_page, duration, recording_link, caller_phone, email_address, sentiment, customer_id)
VALUES ('parrains', 'Phone Call', 12345, 'Unique Lead', 'Unique Lead', 'Google Ads', 'CPC', 'Air Conditioning Repair', '/services/ac-repair', 120, 'http://example.com/recording.mp3', '+1234567890', 'lead@example.com', 'Positive', 'cust_001')
ON DUPLICATE KEY UPDATE
    status = VALUES(status),
    sh_status = VALUES(sh_status),
    source = VALUES(source),
    medium = VALUES(medium),
    keyword = VALUES(keyword),
    lead_page = VALUES(lead_page),
    duration = VALUES(duration),
    recording_link = VALUES(recording_link),
    caller_phone = VALUES(caller_phone),
    email_address = VALUES(email_address),
    sentiment = VALUES(sentiment),
    customer_id = VALUES(customer_id),
    lead_data = CURRENT_TIMESTAMP; --add this to perfex too
