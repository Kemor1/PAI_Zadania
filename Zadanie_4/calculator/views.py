from django.shortcuts import render

def kalkulator_view(request):
    # Słownik przekazywany do szablonu HTML
    context = {
        'amount': '',
        'months': '',
        'interest': '',
        'errors': [],
        'result': None,
        'totalAmount': None
    }

    if request.method == 'POST':
        # Pobieranie danych (odpowiednik $_POST)
        amount_str = request.POST.get('amount')
        months_str = request.POST.get('months')
        interest_str = request.POST.get('interest')

        # Zachowanie wpisanych danych w formularzu
        context['amount'] = amount_str
        context['months'] = months_str
        context['interest'] = interest_str

        errors = []

        # Walidacja Kwoty
        if not amount_str:
            errors.append('Nie podano kwoty kredytu.')
        else:
            try:
                amount = float(amount_str)
                if amount <= 0:
                    errors.append('Kwota kredytu musi być liczbą większą od zera.')
            except ValueError:
                errors.append('Kwota kredytu musi być poprawną liczbą.')

        # Walidacja Miesięcy
        if not months_str:
            errors.append('Nie podano okresu kredytowania.')
        else:
            try:
                months = int(months_str)
                if months <= 0:
                    errors.append('Okres musi być liczbą całkowitą większą od zera.')
            except ValueError:
                errors.append('Okres musi być poprawną liczbą całkowitą.')

        # Walidacja Oprocentowania
        if not interest_str:
            errors.append('Nie wybrano oprocentowania z listy.')
        else:
            try:
                interest = float(interest_str)
                if interest < 0:
                    errors.append('Oprocentowanie musi być liczbą nieujemną.')
            except ValueError:
                errors.append('Oprocentowanie musi być poprawną liczbą.')

        # Obliczenia, jeśli nie ma błędów
        if not errors:
            if interest == 0:
                result = amount / months
            else:
                monthly_interest_rate = (interest / 100) / 12
                # Potęgowanie w Pythonie to **
                result = amount * monthly_interest_rate / (1 - (1 + monthly_interest_rate) ** -months)
            
            context['result'] = round(result, 2)
            context['totalAmount'] = round(result * months, 2)

        context['errors'] = errors

    # Renderowanie szablonu z podpiętymi danymi z context
    return render(request, 'kalkulator.html', context)