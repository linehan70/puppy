# 🐾 Puppy Daily Tools

A pair of simple, self-contained web pages to help you stay on top of puppy care — a daily schedule checklist and an activity log with timestamps.

No accounts. No cloud. No subscriptions. Just drop the files somewhere and open them.

---

## What's included

| File | Description |
|---|---|
| `puppy.html` | Daily schedule checklist — auto-resets every morning |
| `puppylog.html` | Activity log — standalone, data saved to your device |
| `puppylog_server.html` | Activity log — server version, syncs across all devices |
| `puppylog_data.php` | PHP backend for the server version |

---

## Option A — No server (works for everyone)

Just download `puppy.html` and `puppylog.html` and open them in any browser — Chrome, Safari, Firefox. That's it.

**Works on:** Mac, Windows, iPhone, Android. Anything with a browser.

Data is saved in your browser's local storage and persists between sessions. Each device keeps its own data — this version does not sync between devices.

> **Tip for iPhone/Android:** Open the file in Safari or Chrome, then use "Add to Home Screen" to get an app-like icon on your home screen.

---

## Option B — Self-hosted (syncs across all your devices)

Use this if you want your phone and laptop to share the same log — tap an entry on your phone, see it on your laptop instantly.

You need a machine that can serve PHP — a Synology NAS, a Raspberry Pi, a QNAP, any shared web host, or even MAMP/XAMPP on your Mac.

### Setup on Synology NAS

**1. Install Web Station**
- Open Package Center → search Web Station → install
- Open Web Station → Web Service tab → edit the Default entry → enable PHP

**2. Copy files to your NAS**

Copy these files into `/volume1/web/` via File Station or SMB (`smb://[NAS-IP]/web`):
- `puppylog_server.html`
- `puppylog_data.php`
- `puppy.html` (optional, for the schedule page)

**3. Fix permissions via SSH**
```bash
cd /volume1/web
chown http:http puppylog_server.html puppylog_data.php puppy.html
chmod 755 puppylog_server.html puppylog_data.php puppy.html
```

**4. Open it**
```
http://[YOUR-NAS-IP]/puppylog_server.html
http://[YOUR-NAS-IP]/puppy.html
```

**5. Optional: local DNS**
Add a local DNS entry on your router so you can type a name instead of an IP:
```
puppy.local  →  [YOUR-NAS-IP]
```

### Setup on any PHP host (Raspberry Pi, shared hosting, etc.)

Same idea — copy the files to your web root, make sure PHP is enabled, browse to the file. The PHP backend just reads and writes a `puppylog_data.json` file in the same directory.

---

## Features

### Daily Schedule (`puppy.html`)
- Tap any row to check it off — stamps the time it was completed
- Progress bar tracks how far through the day you are
- Auto-resets every morning at midnight
- Manual reset button if needed

### Activity Log (`puppylog.html` / `puppylog_server.html`)
- One-tap logging for: potty outside, accident inside, nap, wake up, fed, playtime, training, bedtime, morning wake up
- Each button shows when that activity last happened
- Running log sorted by time, grouped by date
- Tap "edit time" on any entry to correct the time with a dropdown picker
- Hover any entry to delete it
- Dark mode syncs between both pages

---

## Troubleshooting

**"Website not set up yet" on Synology**
→ Web Station is installed but PHP is not enabled. Go to Web Station → Web Service tab → edit Default → enable PHP.

**Red "save error" status indicator**
→ Permissions issue. Re-run the chown/chmod commands in Step 3.

**Page loads but not via root URL**
→ Type the full filename: `http://[IP]/puppylog_server.html`

**Data not syncing between devices**
→ Make sure both devices are using the server version, not the standalone version.

---

## License

Do whatever you want with it. No attribution required.
