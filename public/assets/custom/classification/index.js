
const $base_api            = getLocalStorageBaseApi();
const $base_url            = getLocalStorageBaseUrl();
const $url                 = `${$base_api}/classification`;
const $listClassifications = document.querySelector('.list-classification');
const $pagination          = document.querySelector('.pagination-list');

const $init = ()=>
{ 
    handleListPanel($url);
}

const classification = (id, name)=>
{
    return `
    <span class="icon-text">
        <span class="icon mr-4">
            <i class="fa-solid fa-bars-progress"></i>
        </span>
        <span class="has-text-weight-normal">
            ${name}
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
        let i = 1, id = -999;
        let tag = e.target
        let href = null;
        let action =  '';
        do
        {
            if(tag.tagName === "A")
            {
                if(tag.classList.contains('edit'))
                {
                    action = 'edit';
                }
                if(tag.classList.contains('remove'))
                {
                    action = 'remove';
                }
                href = tag.href;
                i = 100;
            }
            tag = tag.parentNode;
            i ++;
        }while(i < 50)
        const aHref = href.split('/');
        id = aHref[aHref.length-1];
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
        //console.log(`${$base_url}/classification/store/${id}`);
        redirect(`${$base_url}/classification/store/${id}`);
    }
}


const fillListItems = (data) =>
{
    $listClassifications.innerHTML = '';
	data = data.filter(item => item.id > 2);
    data.forEach(item => {
        const {id,name} = item;
        const div = document.createElement('div');
        div.className =`panel-block is-flex-direction-row is-justify-content-space-between`;
        div.innerHTML = classification(id, name);
        $listClassifications.append(div);
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

const handleListPanel = async (url)=>
{
    const response = await getListClassification(url); 
    //const codeStatus = response.status;
    const {data, links}  = await response.json();
    fillListItems(data);
    fillPaginationItems(links);
    //console.info(codeStatus);
    //console.info(data);
    //console.info(links);
}
const handleDeleteClassification = async ()=>
{
    const id = getLocalStorageId();
    const response = await deleteClassification(id);
    const {status} = response;
    const data = await response.json();
    if(status == 200)
    {
        closeModal($modal);
        $init();
        return;
    }
    handleContentModal(data.message, 'error');
}

//* ---------------------------------------------------------------------------
//* Fetch
//* ---------------------------------------------------------------------------
const getListClassification = async (url)=>
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
const deleteClassification = async (id)=>
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
$pagination.addEventListener('click', handleNextPagination);
$listClassifications.addEventListener('click', handleClickAction);
$btnDelete.addEventListener('click', handleDeleteClassification);

(()=>{
    $init();
})()
