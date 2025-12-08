# 📌 POC : Inscription, Authentification & Messagerie asynchrone (DDD + Hexagonal)

## 🚀 Fonctionnalités principales

### 🔐 Inscription
- Un utilisateur peut créer un compte via un formulaire d’inscription.
- Son mot de passe est **haché** grâce au composant `PasswordHasher` de Symfony.
- Une fois le compte créé, un **événement de domaine** `UserRegistered` est émis.
- Cet événement est consommé en asynchrone par Messenger pour envoyer un **email de bienvenue**.

### 🔑 Authentification
- Authentification via **formulaire de connexion** (`app_login`).
- Gestion de la session utilisateur par le firewall `main`.
- Déconnexion via la route `app_logout`.
- Contrôle d’accès basé sur le rôle de l’utilisateur et sa session.

### 📬 Messagerie asynchrone (Messenger)
- Utilisation de **Symfony Messenger** pour déléguer certaines actions sans bloquer l’utilisateur.
- Exemple : lors de l’inscription, Messenger envoie en arrière-plan un email de confirmation.
- Les événements de domaine (`UserRegistered`, etc.) sont routés vers une **file asynchrone**.
- Le transport par défaut utilise RabbitMQ (`messenger_messages`).

---

## 🛠️ Stack technique

- **Symfony 6.4** (framework principal)
- **Doctrine ORM** (persistance des utilisateurs)
- **Symfony Security** (authentification et gestion des sessions)
- **Symfony Messenger** (gestion des tâches asynchrones)
- **Symfony Mailer** (envoi des emails)

---

## ⚡ Workflow d’inscription

1. L’utilisateur soumet le formulaire d’inscription.
2. Le **Use Case `RegisterUser`** crée l’utilisateur et hache son mot de passe.
3. L’utilisateur est persisté en base.
4. Un événement `UserRegistered` est dispatché via Messenger.
5. Le handler `SendWelcomeEmailHandler` est appelé en asynchrone et envoie un email de bienvenue.

