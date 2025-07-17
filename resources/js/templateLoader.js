function loadTemplate(templateName) {
    if (!templateName) return;

    const contactId = window.contactId;
    if (!contactId) {
        alert("contact ID が見つかりません");
        return;
    }

    fetch(`/admin/templates/${templateName}/${contactId}`)
        .then((response) => {
            if (!response.ok)
                throw new Error("テンプレートの取得に失敗しました");
            return response.text();
        })
        .then((html) => {
            const text = html.replace(/<[^>]*>?/gm, ""); // HTMLタグを除去
            const textarea = document.getElementById("reply_message");
            if (textarea) textarea.value = text;
        })
        .catch((error) => {
            console.error(error);
            alert("テンプレートの読み込み中にエラーが発生しました");
        });
}

window.loadTemplate = loadTemplate;
