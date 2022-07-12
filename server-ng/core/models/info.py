from django.db import models


class Category(models.Model):
    name = models.CharField(max_length=200, null=False)
    createTime = models.DateTimeField(null=False)
    updateTime = models.DateTimeField(null=False)


class Post(models.Model):
    category = models.ForeignKey("Category", on_delete=models.CASCADE)
    title = models.CharField(max_length=200, null=False)
    content = models.TextField(null=True)
    draftFlag = models.BooleanField(null=False, default=True)
    createTime = models.DateTimeField(null=False)
    updateTime = models.DateTimeField(null=False)
