const edit_profil_user = document.getElementById('edit_profil_user');
const frame_creation = document.querySelector('.frame_creation');
const btnCancel = document.querySelector('.btnCancel');
const image = document.querySelector('.image');
const formuler_1 = document.querySelector('.formuler_1');
const formuler_2 = document.querySelector('.formuler_2');
const btnCancel2 = document.querySelector('.btnCancel2');

edit_profil_user.addEventListener('click', function() {
    frame_creation.style.display='block';
    formuler_1.style.display = "block";
    formuler_2.style.display = "none";
});

image.addEventListener('click', function(){
    frame_creation.style.display='block';
    formuler_1.style.display = "none";
    formuler_2.style.display = "block";
});

btnCancel.addEventListener('click', function() {
    frame_creation.style.display='none';
});

btnCancel2.addEventListener('click', function() {
    frame_creation.style.display='none';
});
