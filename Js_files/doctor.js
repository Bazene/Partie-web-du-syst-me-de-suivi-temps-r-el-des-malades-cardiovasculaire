const btn_add_doctor = document.querySelector('.btn_add_doctor');
const btnCancel = document.querySelector('.btnCancel');
const frame_creation = document.querySelector('.frame_creation');

btn_add_doctor.addEventListener('click', function() {
    frame_creation.style.display='block';
});

btnCancel.addEventListener('click', function() {
    frame_creation.style.display='none';
});