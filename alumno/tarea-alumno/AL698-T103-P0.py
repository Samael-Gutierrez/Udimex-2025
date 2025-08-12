def cajero_automatico(cantidad):
    billetes = [ 500, 200, 100, 50, 20, 10, 5, 2, 1] 
    resultado = {}

    if cantidad <= 0:
        print("Ingrese la cantidad que deseas retirar .")
        return

    for billete in billetes:
        if cantidad >= billete:
            num_billetes = cantidad // billete
            resultado[billete] = num_billetes
            cantidad -= num_billetes * billete

    if cantidad > 0:
    	print("No se puede dar la.cantidad deseada  ")
    else:
        print("Billetes entregados:")
        for billete, num in resultado.items():
            print(f"${billete}: {num} billete(s)")

cantidad = int(input("Ingrese la cantidad a retirar: "))
cajero_automatico(cantidad)