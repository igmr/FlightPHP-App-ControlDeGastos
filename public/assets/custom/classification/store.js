
const $form     = document.querySelector('#store');
const $base_api = getLocalStorageBaseApi();
const $url      = `${$base_api}/classification`;
const $base_url = getLocalStorageBaseUrl();
const $home     = `${$base_url}/classification`;

const $init = async ()=>
{
    console.log('form-store-classification');
}

const handleShowError = (data)=>
{
    //console.log(data);

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
}

const handleSubmit = async (e)=>
{
    e.preventDefault();
    const id          = $form.id.value;
    const name        = $form.name.value;
    const description = $form.description.value;
    if(id == 1 || id == 2)
    {
        console.error('Error')
        return;
    }
    const payload = {name, description};
    let response = null;
    if( id < 0)
    {
        response = await postClassification(payload);
    }
    if(id > 2)
    {
        response = await putClassification(id, payload);
    }
    const {status} = response;
    if(status == 201 || status == 200)
    {
        window.location.href = $home;
    }
    const errors = await response.json();
    handleShowError(errors);
}

const postClassification = async (payload)=>
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
const putClassification = async (id, payload)=>
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

$form.addEventListener('submit', handleSubmit);

(async ()=>
{
    await $init();
})()