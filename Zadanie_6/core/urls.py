from django.contrib import admin
from django.urls import path
from calculator.views import kalkulator_view, login_view, logout_view

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', kalkulator_view, name='kalkulator'),
    path('login/', login_view, name='login'),
    path('logout/', logout_view, name='logout'),
]