# Deploying TRIV

The app is a plain PHP + MySQL application. It now reads its database
credentials from environment variables, so the same code runs unchanged on
XAMPP and on a hosted platform.

---

## Why not Vercel

Vercel has no official PHP runtime, gives you a read-only filesystem, and
offers no MySQL. Running TRIV there would mean a community PHP runtime plus
rewriting session handling (serverless has no persistent `/tmp`, so admin
logins drop) and moving every admin image upload to blob storage. A normal
PHP container avoids all of that.

---

## Recommended: Render (app) + Aiven (MySQL)

Both have a free tier that does not expire and does not need a card.

### 1. Database — Aiven for MySQL (free)

1. Sign up at <https://aiven.io> and create a **MySQL** service on the **Free**
   plan (1 CPU / 1 GB RAM / 1 GB storage — far more than this app needs).
2. From the service overview, copy the **host**, **port**, **user**,
   **password**, and **database name**.
3. Import the schema and seed data:

   ```bash
   mysql --host=<HOST> --port=<PORT> --user=<USER> --password=<PASS> \
         --ssl-mode=REQUIRED <DBNAME> < triv_db.sql
   ```

   (Aiven's default database is called `defaultdb`. You can use it as-is or
   create a `triv_db` database first.)

### 2. App — Render (free)

1. Push this repo to GitHub.
2. On <https://render.com>, **New → Web Service**, connect the repo.
3. Render detects `render.yaml` and the `Dockerfile`. Choose the **Free** plan.
4. Add these environment variables (Render → Environment):

   | Key       | Value                          |
   |-----------|--------------------------------|
   | `DB_HOST` | your Aiven host                |
   | `DB_PORT` | your Aiven port                |
   | `DB_NAME` | `defaultdb` (or `triv_db`)     |
   | `DB_USER` | `avnadmin`                     |
   | `DB_PASS` | your Aiven password            |
   | `DB_SSL`  | `1`                            |

5. Deploy. First build takes a few minutes.

**Free-tier caveats:** the service sleeps after 15 minutes of inactivity and
takes ~1 minute to wake, and you get 750 instance-hours per month. Sleeping
also clears the container's disk — see *Uploads* below.

---

## Alternative: Railway (app + MySQL together)

Railway can host both the container and MySQL in one project, which is less
setup. It gives a one-time $5 trial credit and then costs $5/month, so it is
not free long-term.

1. **New Project → Deploy from GitHub repo** (Railway uses the `Dockerfile`).
2. **New → Database → MySQL** in the same project.
3. In the web service's Variables, reference the database:
   `DB_HOST=${{MySQL.MYSQLHOST}}`, `DB_PORT=${{MySQL.MYSQLPORT}}`,
   `DB_NAME=${{MySQL.MYSQLDATABASE}}`, `DB_USER=${{MySQL.MYSQLUSER}}`,
   `DB_PASS=${{MySQL.MYSQLPASSWORD}}`. Leave `DB_SSL` unset (internal network).
4. Import `triv_db.sql` using the connection string Railway shows.

---

## Running locally

Nothing changed for XAMPP — with no environment variables set, the app falls
back to `localhost` / `root` / no password / `triv_db`.

With Docker:

```bash
docker build -t triv .
docker run -p 8080:80 \
  -e DB_HOST=host.docker.internal -e DB_NAME=triv_db \
  -e DB_USER=root -e DB_PASS= \
  triv
```

---

## Known limitations to plan around

**Uploads are ephemeral.** Admin image uploads land in `assets/images/` and
client plan/resume uploads in `uploads/`, both inside the container. On
Render's free tier (and on any redeploy anywhere) that disk is wiped, so
uploaded files disappear while database rows still reference them. Fixes, in
order of effort: attach a Render persistent disk (paid), move uploads to an
object store such as Cloudinary or S3, or store the files as BLOBs in MySQL.

**Sessions are file-based.** Fine on a single always-on container. Admins get
logged out whenever the container restarts or sleeps. Moving sessions into
MySQL fixes that and is a prerequisite for running more than one instance.

**Generated service pages are ephemeral too.** Creating a service writes a
`public/services_<slug>.php` file. That file lives on the same disposable
disk, so it vanishes on redeploy. Rendering services from the database
instead of generating files would remove this class of problem entirely.

**Change the admin password.** `README.md` publishes the default
`admin@triv.com` / `admin1234` credentials and this repository is public.
Change the password before the site is reachable from the internet, and
delete the credentials from the README.
