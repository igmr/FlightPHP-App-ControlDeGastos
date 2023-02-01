
const $form          = document.querySelector('#store');
const $base_api      = getLocalStorageBaseApi();
const $url           = `${$base_api}/operation`;
const $base_url      = getLocalStorageBaseUrl();
const $home          = `${$base_url}/`;
const $listDashboard = document.querySelector('.list-subclassification');

const $init = ()=>
{
    console.info('Dashboard');
}

const handleShowError = (data, income = true)=>
{
    if(!income)
    {
        data = data[0]
    }
    $form.amount
        .classList.remove('is-danger', 'is-success');
    document.querySelector('#info-amount')
        .classList.add('is-hidden', 'is-success');
    document.querySelector('#info-amount')
        .classList.remove('is-danger');

    $form.description
        .classList.remove('is-danger', 'is-success');
    document.querySelector('#info-description')
        .classList.add('is-hidden', 'is-success');
    document.querySelector('#info-description')
        .classList.remove('is-danger');
    
    if(data.amount.length > 0)
    {
        data.amount.forEach(item=>{
            $form.amount
                .classList.add('is-danger');
            document.querySelector('#info-amount')
                .classList.remove('is-hidden', 'is-success');
            document.querySelector('#info-amount')
                .classList.add('is-danger');
            document.querySelector('#info-amount')
                .innerText = item;
        });
    }
    else
    {
        $form.amount
                .classList.add('is-success');
        document.querySelector('#info-amount')
            .classList.remove('is-hidden', 'is-danger');
        document.querySelector('#info-amount')
            .classList.remove('is-success');
    }
    $form.description
            .classList.add('is-success');
    document.querySelector('#info-description')
        .classList.remove('is-hidden');
    if(!income)
    {
        document.querySelector('#select')
            .classList.add('is-success');
        document.querySelector('#info-subclassification')
            .classList.remove('is-hidden');
    }
}

const handleSubmit = async (e)=>
{
    e.preventDefault();
    const id = $form.id.value;
    const action = $form.action.value;
    let amount = '';
    if(action == 'income' || action == 'outcome')
    {
        try {
            amount = $form.amount.value;
        } catch (e) {
        }
        const description = $form.description.value ?? '';
        let income = action == 'income' ? true : false;
        let payload = {amount, description};
        if(action == 'income')
        {
            payload = {...payload, subclassification : 1}
        }
        if(action == 'outcome')
        {
            const subclassification = $form.subclassification.value;
            payload = {...payload, subclassification};
        }
        let response =  null;
        if(id < 0)
        {
            response = await postOperation(payload, income);
        }
        if(id > 0)
        {
            delete payload.amount;
            if(action == 'income')
            {
                delete payload.subclassification;
            }
            console.log(payload);
            response = await putOperation(payload, id);
        }
        const {status} = response;
        if(status == 201 || status == 200)
        {
            window.location.href = $home;
        }
        const errors = await response.json();
        console.error(errors);
        handleShowError(errors, income);
        return;
    }
    window.location.href = $home;
    return;
}

const postOperation = async (payload, income = true)=>
{
    let url = `${$url}/outcome`;
    if(income)
    {
        url = `${$url}/income`;
    }
    console.log(url);
    const options = {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json',
        },
        mode:'cors',
        body: JSON.stringify(payload),
    }
    return await fetch(url, options);
}
const putOperation = async (payload, $id)=>
{
    let url = `${$url}/${$id}`;
    const options = {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
        },
        mode:'cors',
        body: JSON.stringify(payload),
    }
    return await fetch(url, options);
}

$form.addEventListener('submit', handleSubmit);

(()=>{
    $init();
})()
