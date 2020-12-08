

let state = {
    errors: ['name', 'phone'],
    name: '',
    phone: '',

};

const validate = e => {
    const field = store(e);
    switch (field) {
        case 'name': checkFieldLength(field, e.value, 2);break;
        case 'phone': checkFieldLength(field, e.value, 10);break;
    }

    if (state.errors.includes(field)) {
        e.classList.add('is-invalid');
    } else {
        e.classList.remove('is-invalid');
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
    if (!state.errors.length && state.name && state.phone) {
        document.getElementById('info_container')
            .innerHTML = '<div class="alert alert-success" role="alert">Ваше замовлення успішно оформлено. Дякуємо за покупку!</div>';

        delete state.errors;
        $.post(domain + 'cart/checkout', {
            data: state
        }, r => console.log(JSON.parse(r)));
    }
}
