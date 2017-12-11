-- total de ventas por mes
SELECT anio, mes, total 
    FROM (SELECT extract(year from fecha)::integer as anio,
                 extract(month from fecha)::integer as mes,
                 rank() over (partition by extract (year from fecha), extract(month from fecha) order by sum(cantidad) desc) as lugar,
                 sum(cantidad) as total
                 FROM detalleorden deo join orden o ON o.id = deo.id
                 group by 1,2,fecha) as totales
                 WHERE anio = '2013'
                 order by 2;
       
 -- total de ventas por año
 SELECT extract(year from fecha)::integer as anio,
        sum(cantidad) as total
      FROM detalleorden deo join orden o ON o.id = deo.id
      group by anio
      order by anio;
      
-- total de ventas por mes 
SELECT anio, mes, usuario, total 
  FROM (SELECT extract(year from fecha)::integer as anio,
               extract(month from fecha)::integer as mes,
               rank() over (partition by extract (year from fecha), extract(month from fecha) order by sum(cantidad) desc) as lugar,
               u.usuario as usuario,
               sum(cantidad) as total
               FROM detalleorden deo join orden o ON o.id = deo.id
                                     join users u ON deo.id_cliente = u.id
               group by anio,mes,fecha,u.usuario) as totales
               WHERE anio = '2013'
               order by 2;