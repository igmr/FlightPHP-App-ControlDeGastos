
$modal           = document.querySelector('#modal-notification');
$btnDelete       = document.querySelector('#btnDelete');
$btnCancelDelete = document.querySelector('#btnCancelDelete');
$modalTitle      = document.querySelector('.modal-title');
$modalBody       = document.querySelector('.modal-body');

//* ---------------------------------------------------------------------------
//* Modal
//* ---------------------------------------------------------------------------
const openModal = (modal)=>
{
    modal.classList.add('is-active');
}

const closeModal = (modal)=>
{
    modal.classList.remove('is-active');
}

const handleContentModal = (body = '', type = 'default')=>
{
    $modalTitle.innerHTML = '';
    $modalBody.innerHTML = '';
    $btnDelete.classList.remove('is-hidden');
    if(type == 'default')
    {
        title = `<i class="fa-regular fa-trash-can"></i>&nbsp; Delete?`;
        body  = `Sure delete record?`;
    }
    else 
    {
        title = `<i class="fa-solid fa-bomb"></i>&nbsp; Error!`;
        $btnDelete.classList.add('is-hidden');
    }
    $modalTitle.innerHTML = title;
    $modalBody.innerHTML  = body;
}

$btnCancelDelete.addEventListener('click',()=>
{
    closeModal($modal);
})
//* ---------------------------------------------------------------------------
//* End Modal
//* ---------------------------------------------------------------------------
//* Local Storage
//* ---------------------------------------------------------------------------
const setLocalStorageId = (id = -1)=>
{
    window.localStorage.setItem('id', id);
}

const getLocalStorageId = ()=>
{
    return window.localStorage.getItem('id');
}
const setLocalStorageBaseApi = (url = '')=>
{
    window.localStorage.setItem('base_api', url);
}
const getLocalStorageBaseApi = ()=>
{
    return window.localStorage.getItem('base_api');
}
const setLocalStorageBaseUrl = (url = '')=>
{
    window.localStorage.setItem('base_url', url);
}
const getLocalStorageBaseUrl = ()=>
{
    return window.localStorage.getItem('base_url');
}
//* ---------------------------------------------------------------------------
//* End LocalStorage
//* ---------------------------------------------------------------------------

const handleButtonBurgers = ()=>
{
    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
    // Add a click event on each of them
    $navbarBurgers.forEach( el => {
        el.addEventListener('click', () => {
            // Get the target from the "data-target" attribute
            const target = el.dataset.target;
            const $target = document.getElementById(target);
            // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
            el.classList.toggle('is-active');
            $target.classList.toggle('is-active');
        });
    });
}

const redirect = (url = '/')=>
{
    window.location.href = url;
}

document.addEventListener('DOMContentLoaded', () => {
    setLocalStorageBaseApi(`https://ivangabino.com/apis/Lumen-Api-REST-ControlDeGastos/api`);
    setLocalStorageBaseUrl('http://localhost:8080');
    setLocalStorageId();
    handleButtonBurgers();
});
