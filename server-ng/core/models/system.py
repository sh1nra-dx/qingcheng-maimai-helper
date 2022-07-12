from django.db import models


class SystemSettings(models.Model):
    isMaintenance = models.BooleanField(default=True, null=False)
    autoReview = models.BooleanField(default=True, null=False)
