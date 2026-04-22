from django.db import models

class Uzytkownik(models.Model):
    login = models.CharField(max_length=50, unique=True)
    haslo = models.CharField(max_length=50)

    def __str__(self):
        return self.login