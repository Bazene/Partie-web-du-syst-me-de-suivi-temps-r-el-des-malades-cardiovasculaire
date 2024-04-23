const btn_see_more_cash = document.querySelector('.btn_see_more_cash');
const btn_see_more_show = document.querySelector('.btn_see_more_show');
const other_patient_attributs = document.querySelector('.other_patient_attributs');
const btn_add_tuteur = document.querySelector('.btn_add_tuteur');
const btnCancel = document.querySelector('.btnCancel');
const frame_creation = document.querySelector('.frame_creation');
const btn_editNotification = document.querySelector('.btn_editNotification');
const frame_creation2 = document.querySelector('.frame_creation2');
const btnCancel2 = document.querySelector('.btnCancel2');

btn_see_more_cash.addEventListener('click', function() {
    btn_see_more_cash.style.display = 'none';
    btn_see_more_show.style.display = 'block';
    other_patient_attributs.style.display = 'flex'
});

btn_see_more_show.addEventListener('click', function() {
    btn_see_more_cash.style.display = 'block';
    btn_see_more_show.style.display = 'none';
    other_patient_attributs.style.display = 'none'
});

btn_add_tuteur.addEventListener('click', function() {
    frame_creation.style.display='block';
});

btnCancel.addEventListener('click', function() {
    frame_creation.style.display='none';
});

btnCancel2.addEventListener('click', function(){
    frame_creation2.style.display = 'none';
});

btn_editNotification.addEventListener('click', function() {
    console.log("hello word");
    frame_creation2.style.display = 'block';
});