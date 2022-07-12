from django.db import models


class Game(models.Model):
    chName = models.CharField(max_length=100, null=False)
    enName = models.CharField(max_length=100, null=True)
    gameLogo = models.TextField(null=True)
    createTime = models.DateTimeField(null=False)
    updateTime = models.DateTimeField(null=False)


class Shop(models.Model):
    name = models.CharField(max_length=200, null=False)
    address = models.TextField(null=False)
    fixedLocation = models.TextField(null=False)
    description = models.TextField(null=True)
    creditPrice = models.CharField(max_length=20, null=True)
    businessTime = models.CharField(max_length=200, null=True)
    remark = models.TextField(null=True)
    createTime = models.DateTimeField(null=False)
    updateTime = models.DateTimeField(null=False)


class ShopPhoto(models.Model):
    shop = models.ForeignKey("Shop", on_delete=models.CASCADE)
    user = models.OneToOneField("User", on_delete=models.CASCADE)
    source = models.TextField(null=False)
    createTime = models.DateTimeField(null=False)
    reviewFlag = models.IntegerField(null=False, default=0)
    reviewRemark = models.TextField(null=True)
    reviewTime = models.DateTimeField(null=True)


class Cabinet(models.Model):
    game = models.OneToOneField("Game", on_delete=models.CASCADE)
    shop = models.ForeignKey("Shop", on_delete=models.CASCADE)
    version = models.CharField(max_length=100, null=False)
    credit = models.IntegerField(null=True)
    number = models.IntegerField(null=True)
    remark = models.TextField(null=True)
    enablePlayerCount = models.BooleanField(null=False, default=False)
    playerCount = models.IntegerField(null=False, default=0)
    maxCapacity = models.IntegerField(null=False, default=0)
    playerCountUpdateTime = models.DateTimeField(null=False)
    createTime = models.DateTimeField(null=False)
    updateTime = models.DateTimeField(null=False)
