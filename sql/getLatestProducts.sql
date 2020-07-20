SELECT product.id, product.name, product.code, product.price, product.new, product.short_description, images.image1
FROM handicrafts.product
JOIN handicrafts.images ON images.code = product.code
/*WHERE status = :status AND new = 'new' ORDER BY code DESC LIMIT :count*/