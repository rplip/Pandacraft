
let app = {

    init() {
        console.log('DOM LOADED');
        app.editFormVisible();
        app.closePopup();
    },

    editFormVisible() {
        const button = document.getElementById('editButton');
        button.onclick = function() {
            let selectedDiv = document.querySelectorAll('.editable');
            for (let i = 0; i < selectedDiv.length; i++) {
                const element = selectedDiv[i];
                element.classList.toggle('edition');
            }
        }
    },

    closePopup() {
        let elements = document.querySelectorAll('.disapear');
        for (let i = 0; i < elements.length; i++) {
            const element = elements[i];
            setTimeout( function() {
                element.classList.add('dnone');
            }, 5000);
        }
    }
}

document.addEventListener('DOMContentLoaded', app.init);