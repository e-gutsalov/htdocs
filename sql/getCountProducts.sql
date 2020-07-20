SELECT product.category_id AS 'categoryId', count(product.category_id) AS 'count'
FROM category
JOIN product ON product.category_id = category.category
GROUP BY category_id