
const $base_api               = getLocalStorageBaseApi();
const $base_url            = getLocalStorageBaseUrl();
const $url                    = `${$base_api}/subclassification`;
const $listSubclassifications = document.querySelector('.list-subclassification');
const $pagination             = document.querySelector('.pagination-list');
//* ---------------------------------------------------------------------------
//* Init
//* ---------------------------------------------------------------------------
const $init = async ()=>
{
    handleListPanel($url)
}
//* ---------------------------------------------------------------------------
//* End Init
//* ---------------------------------------------------------------------------
const subclassification = (id, name, classification)=>
{
    return `
    <span class="icon-text">
        <span class="icon mr-4">
            <i class="fa-solid fa-list-check"></i>
        </span>
        <span class="has-text-weight-normal">
            <div class="media">
                <div class="media-content">
                    <p class="title is-5">${name}</p>
                    <div class="icon-text subtitle is-6">
                        <span class="icon has-text">
                            <i class="fa-solid fa-bars-progress"></i>
                        </span>
                        <span>${classification}</span>
                    </div>
                </div>
            </div>
        </span>
    </span>
    <div>
        <a class="button is-info is-outlined edit" href="${id}">
            <i class="fa-solid fa-pen-nib"></i>
        </a>
        <a class="button is-danger is-outlined remove" href="${id}">
            <i class="fa-regular fa-trash-can"></i>
        </a>
    </div>
    `;
}
const getIdInListClassification =  (e)=>
{
    try 
    {
        const {tagName, href} = e.target;
        let aHref = 0;
        let action = '';
        let a = null;
        if(tagName === 'A')
        {
            a = e.target;
            aHref = href;
        }
        if(tagName === 'svg')
        {
            a = e.target.parentNode;
            aHref = a.href;
        }
        if(tagName === 'path')
        {
            a = e.target.parentNode.parentNode;
            aHref = a.href;
        }
        const aHrefArray = aHref.split('/');
        const id = aHrefArray[aHrefArray.length-1];
        if(a.classList.contains('edit'))
        {
            action = 'edit';
        }
        if(a.classList.contains('remove'))
        {
            action = 'remove';
        }
        return {id, action};
    }catch($ex)
    {
        return {};
    }
}
const handleNextPagination = async (e)=>
{
    e.preventDefault();
    const {tagName, href} = e.target;
    if(tagName === 'A' && href != null)
    {
        if(href !== '')
        {
            await handleListPanel(href);
        }
        return;
    }
}
const handleListPanel = async (url)=>
{
    const response = await getSubclassification(url);
    //const codeStatus = response.status;
    const {data, links}  = await response.json();
    fillListItems(data);
    fillPaginationItems(links);
    //console.info(codeStatus);
    //console.info(data);
    //console.info(links);
}
const handleClickAction = async (e)=>
{
    e.preventDefault();
    const {id, action} = getIdInListClassification(e);
    setLocalStorageId();
    setLocalStorageId(id);
    if(action === 'remove')
    {
        handleContentModal();
        openModal($modal);
    }
     if(action == 'edit')
    {
        redirect(`${$base_url}/subclassification/store/${id}`);
    }
    /**/
}
const handleDeleteSubclassification = async ()=>
{
    const id = getLocalStorageId();
    const response = await deleteSubclassification(id);
    const {status} = response;
    const data = await response.json();
    if(status == 200)
    {
        closeModal($modal);
        $init();
        return;
    }
    //console.log(data);
    handleContentModal(data.message, 'error');
}
//* ---------------------------------------------------------------------------
//* Fill Objects
//* ---------------------------------------------------------------------------
const fillListItems = (data) =>
{
    $listSubclassifications.innerHTML = '';
    data = data.filter(item=> item.id != 2);
    data.forEach(item => {
        const {id,name, classification} = item;
        const div = document.createElement('div');
        div.className =`panel-block is-flex-direction-row is-justify-content-space-between`;
        div.innerHTML = subclassification(id, name, classification);
        $listSubclassifications.append(div);
    });
}
const fillPaginationItems = (links)=>
{
    $pagination.innerHTML =``;
    links.forEach(item=>{
        const li = document.createElement('li');
        const a = document.createElement('a');
        const {active, label, url} = item;
        const isActive = active ? 'is-current' : '';
        if(label == 'pagination.previous')
        {
            a.className = `pagination-link ${isActive}`;
            a.innerHTML = `&lt`;
            if(url != null)
            {
                a.href = url;
            }
            li.append(a);
            $pagination.append(a);
            return;
        }
        if(label == 'pagination.next')
        {
            a.className = `pagination-link ${isActive}`;
            a.innerHTML = `&gt`;
            if(url !== null)
            {
                a.href = url;
            }
            li.append(a);
            $pagination.append(a);
            return;
        }
        a.className   = `pagination-link ${isActive}`;
        a.textContent = label
        a.href        = url;
        li.append(a)
        $pagination.append(li);
        //console.log(active)
        //console.log(label)
        //console.log(url)
    });
}
//* ---------------------------------------------------------------------------
//* End Fill Objects
//* ---------------------------------------------------------------------------
//* Fetch
//* ---------------------------------------------------------------------------
const getSubclassification = async (url)=>
{
    const options = {
        method : 'GET',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'omit',
        headers : {
            'Content-Type' : 'application/json',
        },
    };
    return await fetch(url, options);
}
const deleteSubclassification = async (id)=>
{
    const options = {
        method : 'DELETE',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'omit',
        headers : {
            'Content-Type' : 'application/json',
        },
    };
    return await fetch(`${$url}/${id}`, options);
}
//* ---------------------------------------------------------------------------
//* End Fetch
//* ---------------------------------------------------------------------------
//* AddEventListener
//* ---------------------------------------------------------------------------
$pagination.addEventListener('click', handleNextPagination);
$listSubclassifications.addEventListener('click', handleClickAction);
$btnDelete.addEventListener('click', handleDeleteSubclassification);
//* ---------------------------------------------------------------------------
//* End AddEventListener
//* ---------------------------------------------------------------------------
(()=>{
    $init();
})()
