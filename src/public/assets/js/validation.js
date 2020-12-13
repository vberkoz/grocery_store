

let state = {
    errors: ['name', 'phone', 'email', 'secret'],
    name: '',
    phone: '',
    email: '',
    secret: '',
    address: 'Відсутня',
    message: 'Відсутнє'

};

const validate = e => {
    const field = store(e);
    switch (field) {
        case 'name': checkFieldLength(field, e.value, 2);break;
        case 'phone': checkFieldLength(field, e.value, 10);break;
        case 'email': validateEmail(field, e.value);break;
        case 'secret': checkFieldLength(field, e.value, 6);break;
    }

    if (state.errors.includes(field)) {
        e.classList.add('is-invalid');
    } else {
        e.classList.remove('is-invalid');
    }
}

const validateEmail = (field, email) => {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (re.test(email)) {
        const index = state.errors.indexOf(field);
        if (index > -1) state.errors.splice(index, 1);
        state[field] = email;
    } else {
        if (!state.errors.includes(field)) state.errors.push(field);
    }
}

const checkFieldLength = (field, current, correct) => {
    if (current.length < correct) {
        if (!state.errors.includes(field)) state.errors.push(field);
    } else {
        const index = state.errors.indexOf(field);
        if (index > -1) state.errors.splice(index, 1);
        state[field] = current;
    }
}

const store = e => {
    const field = e.getAttribute('id');
    state[field] = e.value;
    return field;
}

const checkout = () => {
    validate(document.getElementById('name'));
    validate(document.getElementById('phone'));
    let name = !state.errors.find(e => e === 'name');
    let phone = !state.errors.find(e => e === 'phone');
    if (name && phone && state.name && state.phone) {
        document.getElementById('info_container')
            .innerHTML = '<div class="alert alert-success" role="alert">Ваше замовлення успішно оформлено. Дякуємо за покупку!</div>';

        delete state.errors;
        $.post(domain + 'cart/checkout', {
            data: state
        }, r => console.log(JSON.parse(r)));
    }
}
