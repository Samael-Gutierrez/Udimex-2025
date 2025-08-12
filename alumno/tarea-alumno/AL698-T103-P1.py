def cajero_automatico():
    denominaciones = [500, 200, 100, 50, 20, 10, 5, 2, 1]
    cantidad = int(input("Ingrese la cantidad que desea retirar: "))
    total_entregado = {}
    for denominacion in denominaciones:
        if cantidad >= denominacion:
            cantidad_billetes = cantidad // denominacion total_entregado[denominacion] = cantidad_billetes
            cantidad -= cantidad_billetes * denominacion
    print("Billetes y monedas a entregar:")
    for denom, cantidad in total_entregado.items():
        if denom >= 20:
            print(f"Billetes de ${denom}: {cantidad} billete(s)")
        else:
            print(f"Monedas de ${denom}: {cantidad} moneda(s)")
cajero_automatico()