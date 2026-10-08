document.addEventListener('DOMContentLoaded', () => {
    const audioInput = document.getElementById('audio');
    const audioPreview = document.getElementById('audio-preview');
    const coverInput = document.getElementById('cover');
    const coverPreview = document.getElementById('cover-preview');
    const durationBox = document.getElementById('duration');
    const timeText = document.getElementById('time-text');

    if (!audioInput || !audioPreview || !coverInput || !coverPreview) return;

    let audioObjectUrl;
    let coverObjectUrl;

    coverInput.addEventListener('change', () => {
        const file = coverInput.files?.[0];
        if (!file) return;

        if (coverObjectUrl) URL.revokeObjectURL(coverObjectUrl);
        coverObjectUrl = URL.createObjectURL(file);
        coverPreview.src = coverObjectUrl;
        coverPreview.classList.remove('hidden');
    });

    audioInput.addEventListener('change', () => {
        const file = audioInput.files?.[0];
        if (!file) return;

        if (audioObjectUrl) URL.revokeObjectURL(audioObjectUrl);
        audioObjectUrl = URL.createObjectURL(file);
        audioPreview.src = audioObjectUrl;
        audioPreview.classList.remove('hidden');
        audioPreview.onloadedmetadata = () => {
            if (!durationBox || !timeText) return;
            const minutes = Math.floor(audioPreview.duration / 60);
            const seconds = Math.floor(audioPreview.duration % 60).toString().padStart(2, '0');
            timeText.textContent = `${minutes}:${seconds}`;
            durationBox.classList.remove('hidden');
        };
    });

    window.addEventListener('pagehide', () => {
        if (audioObjectUrl) URL.revokeObjectURL(audioObjectUrl);
        if (coverObjectUrl) URL.revokeObjectURL(coverObjectUrl);
    });
});
