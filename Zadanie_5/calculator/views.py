from django.shortcuts import render, redirect

def login_view(request):
    error = ''
    if request.method == 'POST':
        wpisane_haslo = request.POST.get('haslo')
        if wpisane_haslo == 'student':
            request.session['zalogowany'] = True
            return redirect('kalkulator')
        else:
            error = 'Błędne hasło!'
    return render(request, 'login.html', {'error': error})

def logout_view(request):
    request.session['zalogowany'] = False
    return redirect('login')

def kalkulator_view(request):
    if not request.session.get('zalogowany'):
        return redirect('login')

    context = {
        'amount': '',
        'months': '',
        'interest': '',
        'errors': [],
        'result': None,
        'totalAmount': None
    }

    if request.method == 'POST':
        amount_str = request.POST.get('amount')
        months_str = request.POST.get('months')
        interest_str = request.POST.get('interest')

        context['amount'] = amount_str
        context['months'] = months_str
        context['interest'] = interest_str

        errors = []

        if not amount_str:
            errors.append('Nie podano kwoty kredytu.')
        else:
            try:
                amount = float(amount_str)
                if amount <= 0:
                    errors.append('Kwota kredytu musi być liczbą większą od zera.')
            except ValueError:
                errors.append('Kwota kredytu musi być poprawną liczbą.')

        if not months_str:
            errors.append('Nie podano okresu kredytowania.')
        else:
            try:
                months = int(months_str)
                if months <= 0:
                    errors.append('Okres musi być liczbą całkowitą większą od zera.')
            except ValueError:
                errors.append('Okres musi być poprawną liczbą całkowitą.')

        if not interest_str:
            errors.append('Nie wybrano oprocentowania z listy.')
        else:
            try:
                interest = float(interest_str)
                if interest < 0:
                    errors.append('Oprocentowanie musi być liczbą nieujemną.')
            except ValueError:
                errors.append('Oprocentowanie musi być poprawną liczbą.')

        if not errors:
            if interest == 0:
                result = amount / months
            else:
                monthly_interest_rate = (interest / 100) / 12
                result = amount * monthly_interest_rate / (1 - (1 + monthly_interest_rate) ** -months)
            
            context['result'] = round(result, 2)
            context['totalAmount'] = round(result * months, 2)

        context['errors'] = errors

    return render(request, 'kalkulator.html', context)