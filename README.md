# 🐾 Puppy Daily Tools

Two simple web pages to help keep a new puppy on track — a daily schedule checklist and an activity log with timestamps. No accounts, no cloud, no subscriptions.

---

## What's included

| File | Description |
|---|---|
| `puppy.html` | Daily schedule — standalone, works on any device |
| `puppylog.html` | Activity log — standalone, works on any device |
| `puppy_server.html` | Daily schedule — server version, syncs across devices |
| `puppylog_server.html` | Activity log — server version, syncs across devices |
| `puppylog_data.php` | PHP backend for the activity log server version |
| `puppyschedule_data.php` | PHP backend for the schedule server version |

The standalone versions (`puppy.html` and `puppylog.html`) work for most people — just download and open. The server versions are for people who want their phone and laptop to stay in sync.

---

## Option A — Standalone (no server required)

Download `puppy.html` and `puppylog.html` and open them in any browser. Done.

Works on Mac, Windows, iPhone, and Android. Data is saved locally in your browser and persists between sessions. Each device keeps its own data independently.

**iPhone / Android tip:** Open in Safari or Chrome and tap "Add to Home Screen" for an app-like icon.

---

## Option B — Self-hosted (syncs across all devices)

For those who want to log something on their phone and see it instantly on their laptop. Requires a machine that can serve PHP — a Synology NAS, Raspberry Pi, QNAP, shared web host, or MAMP/XAMPP on a Mac.

### Synology NAS setup

**1. Install Web Station**

In DSM, open Package Center, search for Web Station and install it. Once installed, open Web Station, go to the Web Service tab, edit the Default entry, and enable PHP.

**2. Copy files to the NAS**

Put all six files into `/volume1/web/` via File Station or SMB (`smb://[NAS-IP]/web`):

```
puppy_server.html
puppylog_server.html
puppylog_data.php
puppyschedule_data.php
```

**3. Set permissions via SSH**

```bash
cd /volume1/web
chown http:http puppy_server.html puppylog_server.html puppylog_data.php puppyschedule_data.php
chmod 755 puppy_server.html puppylog_server.html puppylog_data.php puppyschedule_data.php
```

**4. Open it**

```
http://[YOUR-NAS-IP]/puppy_server.html
http://[YOUR-NAS-IP]/puppylog_server.html
```

**5. Optional — local DNS**

If your router supports local DNS (Firewalla, pfSense, Pi-hole, etc.) you can add an entry like `puppy.local → [NAS-IP]` so you don't have to type the IP address.

### Other PHP hosts

Same steps — drop the files in your web root, make sure PHP is enabled, browse to the file. The PHP backends create a JSON file in the same directory to store data.

---

## Features

### Daily Schedule (`puppy.html` / `puppy_server.html`)
- Tap any row to check it off — records the time it was completed
- Struck-through items show completion time
- Progress bar tracks how far through the day you are
- Auto-resets every morning at midnight
- Manual reset button if needed
- Dark mode

### Activity Log (`puppylog.html` / `puppylog_server.html`)
- One-tap logging for:
  - Outside — pee / poop / both
  - Accident — pee / poop / both
  - Nap started / Woke up
  - Fed
  - Playtime
  - Training
  - Bedtime / Morning wake up
- Each button shows the last time that activity was logged
- Running log sorted by time, grouped by date
- Tap "edit time" on any entry to adjust with a dropdown time picker
- Hover any entry to delete it
- Dark mode syncs between schedule and log pages

---

## Troubleshooting

**"Website not set up yet" on Synology**
Web Station is installed but PHP is not enabled. Go to Web Station → Web Service tab → edit Default → enable PHP.

**Red "save error" status**
Permissions issue. Re-run the chown/chmod commands in step 3 above. Also verify the `http` user has read/write access to the `/web` folder in File Station → right-click → Properties → Permissions.

**Page won't load via root URL**
Type the full filename in the URL — `http://[IP]/puppy_server.html` rather than just `http://[IP]`.

**Data not syncing between devices**
Make sure both devices are using the server versions (`puppy_server.html` and `puppylog_server.html`), not the standalone versions.

**Schedule didn't reset in the morning (standalone version)**
The standalone version resets based on your browser's local date. If you opened the page before midnight and left the tab open, it won't detect the new day until you reload. The server version handles this correctly across all devices.

---

## License

Do whatever you want with it. No attribution required.
