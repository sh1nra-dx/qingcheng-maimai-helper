from django.db import models


class MaiBotWhitelist(models.Model):
    groupUim = models.CharField(max_length=50, null=False)
    enableMai = models.BooleanField(default=False, null=False)
    enableQueue = models.BooleanField(default=False, null=False)
    enableLAF = models.BooleanField(default=False, null=False)
    createTime = models.DateTimeField(null=False)
    updateTime = models.DateTimeField(null=False)
