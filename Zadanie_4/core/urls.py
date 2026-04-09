from django.contrib import admin
from django.urls import path
from calculator.views import kalkulator_view # Importujemy nasz widok

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', kalkulator_view, name='kalkulator'), # Strona główna odpala kalkulator
]