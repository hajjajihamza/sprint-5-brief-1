-- Insertion des rôles par défaut
INSERT INTO roles (name) VALUES ('admin'), ('candidat'), ('recruteur');

-- Insertion des utilisateurs par défaut
-- password : 123456
INSERT INTO users (name, email, password, role_id) VALUES
('admin', 'admin@admin.com', '$2y$12$6NODbVOnaHAxdyHyBsGV8.OMm/Uc8uROFNrcn.80OOsK6.L1fJC.O', 1),
('candidat', 'candidat@candidat.com', '$2y$12$22.JjCu3RlyhHl7vg11Kte/KvrrMUjcKkaUpotvBHtoy.lUWWJCRa', 2),
('recruteur', 'recruteur@recruteur.com', '$2y$12$BPrREiTo/QdiR3gIcG5vBeJRPjDrXu7h8iKI6icGxu3ogX/2YWray', 3);