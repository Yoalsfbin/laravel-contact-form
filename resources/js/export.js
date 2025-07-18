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
            a.download = "contacts.csv";
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
