document.getElementById("export-btn").addEventListener("click", function () {
    const loading = document.getElementById("loading");
    loading.classList.remove("hidden");

    fetch("/admin/contacts/export")
        .then((response) => {
            if (!response.ok) throw new Error("出力失敗");
            return response.blob();
        })
        .then((blob) => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = getTimestampedFilename("お問い合わせ", "csv");
            document.body.appendChild(a);
            a.click();
            a.remove();
        })
        .catch((error) => {
            alert("CSVの出力に失敗しました");
            console.error(error);
        })
        .finally(() => {
            loading.classList.add("hidden");
        });
});

function getTimestampedFilename(base = "output", ext) {
    const now = new Date();
    const yyyy = now.getFullYear();
    const mm = String(now.getMonth() + 1).padStart(2, "0");
    const dd = String(now.getDate()).padStart(2, "0");
    const hh = String(now.getHours()).padStart(2, "0");
    const min = String(now.getMinutes()).padStart(2, "0");
    const ss = String(now.getSeconds()).padStart(2, "0");

    return `${base}_${yyyy}${mm}${dd}_${hh}${min}${ss}.${ext}`;
}
