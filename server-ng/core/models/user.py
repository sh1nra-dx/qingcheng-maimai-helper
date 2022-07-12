from django.db import models


class Role(models.Model):
    name = models.CharField(null=False, max_length=50)


class User(models.Model):
    role = models.ForeignKey("Role", on_delete=models.CASCADE)
    openId = models.CharField(max_length=50, null=True)
    name = models.CharField(max_length=100, null=True)
    avatar = models.TextField(null=True)
    loginEmail = models.CharField(max_length=100, null=True)
    loginPwd = models.CharField(max_length=255, null=True)
    qqUim = models.CharField(max_length=50, null=True)
    emailHash = models.CharField(max_length=6, null=True)
    createTime = models.DateTimeField(null=False)
    updateTime = models.DateTimeField(null=False)
