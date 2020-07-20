SELECT orders.customers_id, customers.name, customers.address, customers.phone, customers.comment, orders.date, orders.products, orders.status
FROM customers
JOIN orders ON customers.id = orders.customers_id
/*WHERE customers.user_id = :user_id ORDER BY customers.id DESC*/