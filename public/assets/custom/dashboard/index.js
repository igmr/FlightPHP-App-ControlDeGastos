
const $base_api      = getLocalStorageBaseApi();
const $base_url            = getLocalStorageBaseUrl();
const $url           = `${$base_api}/operation`;
const $listDashboard = document.querySelector('.list-dashboard');
const $pagination    = document.querySelector('.pagination-list');
const $aDelete       = document.querySelector('#aDelete');
//* ---------------------------------------------------------------------------
//* Init
//* ---------------------------------------------------------------------------
const $init = ()=>
{
    console.log('dashboard');
    handleListPanel($url);
}
//* ---------------------------------------------------------------------------
//* End Init
//* ---------------------------------------------------------------------------
const dashboard = (id, classification, subclassification
    , description, type, amount, created_at)=>
{
    const created = new Date(created_at);
    //* Fecha
    const date = new Intl.DateTimeFormat("es").format(created);
    const time = created.toLocaleTimeString('es-ES');
    const background = (type == 'income' ? 'success' : 'danger');
    const icon = (type == 'income' ? 'fa-solid fa-arrow-trend-up' : 'fa-solid fa-arrow-trend-down');
    return `
    <span class="icon-text">
        <span class="icon mr-4 has-text-${background}">
            <i class="${icon}"></i>
        </span>
        <span class="has-text-weight-normal">
            <div class="media">
                <div class="media-content">
                    <div class="icon-text title is-6">
                        <span class="icon has-text">
                            <i class="fa-regular fa-calendar-days"></i>
                        </span>
                        <div class="tags has-addons">
                            <span class="tag is-warning is-light">${date}</span>
                            <span class="tag is-warning">${time}</span>
                        </div>
                    </div>
                    <div class="icon-text subtitle is-6">
                        <span class="icon has-text">
                            <i class="fa-solid fa-bars-progress"></i>
                        </span>
                        <div class="tags has-addons">
                            <span class="tag is-${background}">${classification}</span>
                            <span class="tag is-${background} is-light">${subclassification}</span>
                        </div>
                    </div>
                </div>
            </div>
        </span>
    </span>
    <span>$ ${amount}</span>
    `;
}
const handleListPanel = async (url)=>
{
    const response = await getDashboard(url);
    //const codeStatus = response.status;
    const {data, links}  = await response.json();
    fillListItems(data);
    fillPaginationItems(links);
    //console.info(codeStatus);
    //console.info(data);
    //console.info(links);
}
const fillListItems = (data) =>
{
    $listDashboard.innerHTML = '';
    data.forEach(item => {
        const {id, classification, subclassification
            , description, type, amount, created_at} = item;
        const a     = document.createElement('a');
        a.href      = `${id}`; 
        a.className = `panel-block is-flex-direction-row is-justify-content-space-between`;
        a.innerHTML = dashboard(id, classification, subclassification
            , description, type, amount, created_at);
        $listDashboard.append(a);
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
const handleDeleted = (e)=>
{
    e.preventDefault();
    handleContentModal();
    openModal($modal);
}
const handleDeleteClassification = async ()=>
{
    const response = await deleteDashboard();
    const {status} = response;
    const data = await response.json();
    if(status == 200)
    {
        closeModal($modal);
        $init();
        return;
    }
    handleContentModal(data.message, 'error');
    closeModal($modal);
}
const handleClickAction = (e)=>
{
    e.preventDefault();
    const id = getId(e);
    redirect(`${$base_url}/dashboard/store/${id}`);
    return;
}
const getId = (e)=>
{
    let i = 1, id = -999;
    let tag = e.target
    let href = null;
    do
    {
        if(tag.tagName === "A")
        {
            href = tag.href;
            i = 100;
        }
        tag = tag.parentNode;
        i ++;
    }while(i < 50)
    const aHref = href.split('/');
    id = aHref[aHref.length-1];
    return id;
}
//* ---------------------------------------------------------------------------
//* Fetch
//* ---------------------------------------------------------------------------
const getDashboard = async(url)=>
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
const deleteDashboard = async ()=>
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
    return await fetch(`${$url}`, options);
}
//* ---------------------------------------------------------------------------
//* End Fetch
//* ---------------------------------------------------------------------------

$pagination.addEventListener('click', handleNextPagination);
$aDelete.addEventListener('click', handleDeleted);
$btnDelete.addEventListener('click', handleDeleteClassification);
$listDashboard.addEventListener('click', handleClickAction);

(()=>
{
    $init();
})()
