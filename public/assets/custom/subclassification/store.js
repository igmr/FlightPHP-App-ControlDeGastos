
const $form     = document.querySelector('#store');
const $base_api = getLocalStorageBaseApi();
const $url      = `${$base_api}/subclassification`;
const $base_url = getLocalStorageBaseUrl();
const $home     = `${$base_url}/subclassification`;

const $init = async ()=>
{
    console.log('form-store-subclassification');
}

const handleShowError = (data)=>
{
    $form.name
        .classList.remove('is-danger', 'is-success');
    document.querySelector('#info-name')
        .classList.add('is-hidden', 'is-success');
    document.querySelector('#info-name')
        .classList.remove('is-danger');

    $form.description
        .classList.remove('is-danger', 'is-success');
    document.querySelector('#info-description')
        .classList.add('is-hidden', 'is-success');
    document.querySelector('#info-description')
        .classList.remove('is-danger');

    document.querySelector('#select')
        .classList.remove('is-danger', 'is-success');
    document.querySelector('#info-classification')
        .classList.add('is-hidden', 'is-success');
    document.querySelector('#info-classification')
        .classList.remove('is-danger');

    if(data.name.length > 0)
    {
        data.name.forEach(item=>{
            $form.name
                .classList.add('is-danger');
            document.querySelector('#info-name')
                .classList.remove('is-hidden', 'is-success');
            document.querySelector('#info-name')
                .classList.add('is-danger');
            document.querySelector('#info-name')
                .innerText = item;
        });
    }
    else
    {
        $form.name
                .classList.add('is-success');
        document.querySelector('#info-name')
            .classList.remove('is-hidden', 'is-danger');
        document.querySelector('#info-name')
            .classList.remove('is-success');
    }
    $form.description
            .classList.add('is-success');
    document.querySelector('#info-description')
        .classList.remove('is-hidden');
    document.querySelector('#select')
        .classList.add('is-success');
    document.querySelector('#info-classification')
        .classList.remove('is-hidden');
}

const handleSubmit = async (e)=>
{
    e.preventDefault();
    const id             = $form.id.value;
    const name           = $form.name.value;
    const description    = $form.description.value;
    const classification = $form.classification.value;
    if(id == 1 || id == 2)
    {
        console.error('Error')
        return;
    }
    const payload = {name, description, classification}
    console.log(payload);
    let response = null;
    if( id < 0)
    {
        response = await postSubclassification(payload);
    }
    if(id > 2)
    {
        response = await putSubclassification(id, payload);
    }
    const {status} = response;
    if(status == 201 || status == 200)
    {
        window.location.href = $home;
    }
    const errors = await response.json();
    handleShowError(errors);
}
//* ---------------------------------------------------------------------------
//* Fetch
//* ---------------------------------------------------------------------------
const postSubclassification = async (payload)=>
{
    const options = {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json',
        },
        mode:'cors',
        body: JSON.stringify(payload),
    }
    return await fetch($url, options);
}
const putSubclassification = async (id, payload)=>
{
    const options = {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
        },
        mode:'cors',
        body: JSON.stringify(payload),
    }
    return await fetch(`${$url}/${id}`, options);
}
//* ---------------------------------------------------------------------------
//* End Fetch
//* ---------------------------------------------------------------------------
$form.addEventListener('submit', handleSubmit);

(()=>
{
    $init();
})()