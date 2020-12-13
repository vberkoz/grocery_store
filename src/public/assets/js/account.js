

const orders = userId => {
    $.post(domain + 'orders', {
        data: {
            userId: userId
        }
    }, r => {
        r = JSON.parse(r);
        console.log(r);
    });
}

const logout = () => {
    $.get(domain + 'logout', () => {
        document.getElementById('account').classList.add('d-none');
        document.getElementById('login').classList.remove('d-none');
    });
}

const logged = () => {
    $.get(domain + 'logged', r => {
        r = JSON.parse(r);
        if (r) {
            orders(r);
            document.getElementById('account').classList.remove('d-none');
        } else {
            document.getElementById('login').classList.remove('d-none');
        }
    });
}
logged();

const login = () => {
    validate(document.getElementById('email'));
    validate(document.getElementById('secret'));
    let email = !state.errors.find(e => e === 'email');
    let secret = !state.errors.find(e => e === 'secret');
    if (email && secret && state.email && state.secret) {
        $.post(domain + 'login', {
            data: {
                email: state.email,
                secret: state.secret
            }
        }, r => {
            r = JSON.parse(r);
            if (r) {
                orders(r);
                document.getElementById('account').classList.remove('d-none');
                document.getElementById('login').classList.add('d-none');
            }
        });
    }
}
