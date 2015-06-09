INSERT INTO `admin_riego`.`Usuarios` (`idUsuarios`, `login`, `clave`, `email`, `isRoot`) VALUES (NULL, 'admin', 'd033e22ae348aeb5660f', 'drake@l2express.net', '1');
%la pass  esta en SHA1 y es "admin"
% Evento programado par que todas las semanas se ponga regado a 0;
CREATE EVENT `setregado_to_0` 
ON SCHEDULE EVERY 7 DAY STARTS '2015-06-08 00:00:01'
 DO UPDATE Horarios
    SET
      regado = 0;