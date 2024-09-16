CREATE TABLE sh_leads (
    client_id VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    lead_id INT NOT NULL PRIMARY KEY,
    status VARCHAR(255),
    sh_status VARCHAR(255),
    source VARCHAR(255),
    medium VARCHAR(255),
    keyword VARCHAR(255),
    lead_page VARCHAR(255),
    duration INT,
    recording_link VARCHAR(255),
    caller_phone VARCHAR(255),
    email_address VARCHAR(255),
    sentiment VARCHAR(255),
    customer_id VARCHAR(255)
);

