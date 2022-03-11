# Plant suggestions logic

1. Choose a keystone species (e.g. a tree)
2. Define relevant parameters:
 - soil acidity
 - shade amount (take into account the shade the tree creates)
 - hardyness zone the plants are being planted (planting_zone >= plant_zone)
 - the height of the keystone (and other) species
 - moisture preference
 - garden layers
3. Resolve parameters to relevant queries:
 - ph_companion = ph_keystone
 - shade_companion = shade_keystone (or shade_companion < shade_keystone)
 - hardy_companion = hardy_keystone
 - height_companion < height_keystone
 - moisture_companion = moisture_keystone
 - garden_layer_companion != garden_layer_companion


 A = 5

 B = 7


 if(B == A || A + 1 || A -1)