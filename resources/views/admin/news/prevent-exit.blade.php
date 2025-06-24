<script>
    document.addEventListener('turbo:load', () => {
        if (!document.querySelector('input[name="news[title]"]')) return;

        let dirty = false;

        const setDirty = () => { dirty = true };

        const confirmLeave = () =>
            confirm('У вас есть несохранённые изменения. Уйти со страницы?');

        document.addEventListener('input',  setDirty, true);
        document.addEventListener('change', setDirty, true);

        document.querySelectorAll('form').forEach(f =>
            f.addEventListener('submit', () => { dirty = false })
        );

        window.addEventListener('beforeunload', e => {
            if (dirty) {
                e.preventDefault();
                e.returnValue = '';
            }
        });

        document.addEventListener('turbo:before-visit', e => {
            if (dirty && !confirmLeave()) e.preventDefault();
        });

        window.addEventListener('popstate', () => {
            if (!dirty) return;
            if (!confirmLeave()) {
                history.pushState(null, '', location.href);
            }
        });

        document.addEventListener('turbo:before-cache', () => {
            document.removeEventListener('input',  setDirty, true);
            document.removeEventListener('change', setDirty, true);
        }, { once: true });
    });
</script>
