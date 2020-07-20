SELECT product.id, product.name, product.code, product.price, product.new, product.description, images.image1, images.image2, images.image3, images.image4, images.image5
FROM handicrafts.product
JOIN handicrafts.images ON images.code = product.code
/*WHERE product.id = :code*/