# **WilayaAPI : simple , secure and fast API**

### Author : Islem Meghnine

#### Description

WilayaApi is a **simple** and **easy** API to serve wilayas , communes and dairas of all algerien wilayas to be used on forms, avalaible in types of data : JSON , RAW , OPTIONS (html dropdown selection).

## **Documentation**

You can access this API via this route **/find**.

this API serves data in 2 languages **ARABIC** and **FRENCH**.

Serving **ARABIC** data via **/find/arabic**.

Serving **FRENCH** data via **/find/french**.

you can have the name of wilaya or its code depends on what you provide as input by using **getwilaya** action.

###### Demo :

wilayapi.dz/find/arabic/getwilaya.

you must choose the type of data to return **JSON** , **RAW** , **OPTIONS**.

###### Demo :

wilayapi.dz/find/arabic/getwilaya/raw/.

In this last step you can give name (full name or juste indication, the engine will do the rest) or code of wilaya.

###### Demo :

wilayapi.dz/find/arabic/getwilaya/raw/16.

or.

wilayapi.dz/find/arabic/getwilaya/raw/alger | you can also give juste first indication : alg or al.

