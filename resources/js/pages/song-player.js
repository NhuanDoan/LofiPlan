document.addEventListener('DOMContentLoaded', () => {
    const audio = document.getElementById('audio');
    const playButton = document.getElementById('play-btn');
    const playIcon = document.getElementById('play-icon');
    const pauseIcon = document.getElementById('pause-icon');
    const progress = document.getElementById('progress');
    const volume = document.getElementById('volume');
    const title = document.getElementById('player-title');
    const artist = document.getElementById('player-artist');
    const cover = document.getElementById('player-cover');
    const previousButton = document.getElementById('prev-btn');
    const nextButton = document.getElementById('next-btn');
    const searchInput = document.getElementById('searchInput');
    const currentTime = document.getElementById('current-time');
    const totalTime = document.getElementById('total-time');
    const rows = [...document.querySelectorAll('.song-row')];

    if (!audio || !playButton || !progress || !volume || rows.length === 0) return;

    const songs = rows.map((row) => ({
        url: row.dataset.url,
        title: row.dataset.title ?? '',
        artist: row.dataset.artist ?? '',
        cover: row.dataset.cover,
    }));
    let currentIndex = 0;

    function formatTime(seconds) {
        if (!Number.isFinite(seconds)) return '0:00';
        const minutes = Math.floor(seconds / 60);
        const remainder = Math.floor(seconds % 60).toString().padStart(2, '0');
        return `${minutes}:${remainder}`;
    }

    function loadSong(index) {
        currentIndex = (index + songs.length) % songs.length;
        const song = songs[currentIndex];
        if (!song) return;

        audio.src = song.url ?? '';
        if (title) title.textContent = song.title;
        if (artist) artist.textContent = song.artist;
        if (cover) cover.src = song.cover || '/default-cover.png';
        audio.load();
        audio.play().catch(() => {});
    }

    playButton.addEventListener('click', () => {
        if (audio.paused) {
            if (audio.src) audio.play().catch(() => {});
        } else {
            audio.pause();
        }
    });

    previousButton?.addEventListener('click', () => loadSong(currentIndex - 1));
    nextButton?.addEventListener('click', () => loadSong(currentIndex + 1));

    audio.addEventListener('loadedmetadata', () => {
        if (totalTime) totalTime.textContent = formatTime(audio.duration);
    });

    audio.addEventListener('timeupdate', () => {
        if (!Number.isFinite(audio.duration) || audio.duration <= 0) return;
        progress.value = String((audio.currentTime / audio.duration) * 100);
        if (currentTime) currentTime.textContent = formatTime(audio.currentTime);
        if (totalTime) totalTime.textContent = formatTime(audio.duration);
    });

    audio.addEventListener('play', () => {
        playIcon?.classList.add('hidden');
        pauseIcon?.classList.remove('hidden');
    });

    audio.addEventListener('pause', () => {
        playIcon?.classList.remove('hidden');
        pauseIcon?.classList.add('hidden');
    });

    progress.addEventListener('input', () => {
        if (Number.isFinite(audio.duration) && audio.duration > 0) {
            audio.currentTime = (Number(progress.value) / 100) * audio.duration;
        }
    });

    audio.addEventListener('ended', () => loadSong(currentIndex + 1));
    volume.addEventListener('input', () => {
        audio.volume = Number(volume.value);
    });

    searchInput?.addEventListener('input', () => {
        const query = searchInput.value.toLocaleLowerCase();
        rows.forEach((row) => {
            const rowTitle = (row.dataset.title ?? '').toLocaleLowerCase();
            const rowArtist = (row.dataset.artist ?? '').toLocaleLowerCase();
            row.style.display = rowTitle.includes(query) || rowArtist.includes(query) ? '' : 'none';
        });
    });

    rows.forEach((row, index) => row.addEventListener('click', () => loadSong(index)));
    document.querySelectorAll('.song-row a, .song-row form').forEach((control) => {
        control.addEventListener('click', (event) => event.stopPropagation());
    });
});
