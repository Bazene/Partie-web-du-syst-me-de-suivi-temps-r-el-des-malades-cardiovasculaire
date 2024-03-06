const btn_see_more_cash = document.querySelector('.btn_see_more_cash');
const btn_see_more_show = document.querySelector('.btn_see_more_show');
const other_patient_attributs = document.querySelector('.other_patient_attributs');

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