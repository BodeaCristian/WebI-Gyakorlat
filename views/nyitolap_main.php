<main class="hero-page">
    <section class="hero-card">
        <p class="eyebrow">Seholország fővárosa</p>
        <h2>ReNew Kft. - Felújított notebookok, új eséllyel</h2>
        <p>
            A ReNew Kft. kizárólag gyárilag felújított notebookokat értékesít,
            kifejezetten kedvező áron. A kínálatban szereplő műszaki adatok valósak,
            az árak oktatási célból kerültek kialakításra.
        </p>
    </section>

    <section class="feature-grid">
        <article class="feature-card">
            <h3>Miért ReNew?</h3>
            <ul>
                <li>Gyárilag felújított, ellenőrzött eszközök</li>
                <li>Költséghatékony választás diákoknak és irodai használatra</li>
                <li>Fenntarthatóbb döntés a környezetért</li>
            </ul>
        </article>

        <article class="feature-card">
            <h3>Raktári betekintő (helyi videó)</h3>
            <video controls preload="metadata" poster="<?= SITE_ROOT ?>images/nje.png">
                <source src="<?= SITE_ROOT ?>images/minivideo.mp4" type="video/mp4">
                A böngésződ nem támogatja a videó lejátszását.
            </video>
        </article>

        <article class="feature-card">
            <h3>Bemutató videó (YouTube)</h3>
            <div class="video-wrap">
                <iframe
                    src="https://www.youtube.com/embed/KEV_rcmWlo4?si=6dFpbqMYrCDNgDbT"
                    title="ReNew Kft. bemutató"
                    loading="lazy"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
                </iframe>
            </div>
        </article>
    </section>

    <section class="map-card">
        <h3>Üzletünk helye</h3>
        <p>ReNew Kft. - 1234 Seholváros, Notebook tér 7.</p>
        <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps?q=Budapest%2C%20Vaci%20utca%201&output=embed"
                title="ReNew Kft. térkép"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
</main>
