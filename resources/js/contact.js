document.addEventListener("DOMContentLoaded", () => {
    const textarea = document.getElementById("message");
    const counter = document.getElementById("char-count");
    const maxChars = textarea.maxLength;

    function updateCounter() {
        const value = textarea.value;
        const length = value.length;

        if (length === 0) {
            counter.textContent = `最大${maxChars}文字まで入力できます`;
            counter.classList.remove("text-red-500");
        } else if (length >= maxChars) {
            counter.textContent = `最大文字数に達しました`;
            counter.classList.add("text-red-500");
        } else {
            const remaining = maxChars - length;
            counter.textContent = `残り${remaining}文字入力できます`;
            counter.classList.remove("text-red-500");
        }
    }

    if (textarea && counter) {
        textarea.addEventListener("input", updateCounter);
        updateCounter(); // 初期表示
    }

    const form = document.querySelector("form");
    const submitButton = form?.querySelector('button[type="submit"]');

    if (form && submitButton) {
        form.addEventListener("submit", () => {
            submitButton.disabled = true;
            submitButton.innerText = "送信中...";
        });
    }
});
