<!DOCTYPE html>
<html lang="en" class="bg-slate-900 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caveman Weather Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
        theme: {
            extend: {
                colors: {
                    clifford: '#da373d',
                },
                fontFamily: {
                    sans: ['Poppins', 'sans-serif'],
                    serif: ['Poppins', 'serif'],
                },
            }
        }
        }
    </script>
</head>
<body>
    <section class="min-h-screen bg-gradient-to-b from-sky-300 to-amber-500">
        <div class="mx-auto w-full max-w-5xl pt-10 lg:pt-20">
            <div class="px-10 lg:px-20 py-8 lg:py-16 grid grid-cols-2 gap-4 lg:gap-8 rounded-lg bg-cover bg-center " style="background-image: url('https://images.pexels.com/photos/1310757/pexels-photo-1310757.jpeg?auto=compress&cs=tinysrgb&w=600')">

                <div class="mt-3 col-span-1 py-3 pb-5 lg:p-6 text-white rounded-lg">
                    <p class="pt-1 mt-1 col-span-2 text-3xl lg:text-6xl text-white font-medium">
                        <?php
                        echo "{$data->name} ({$data->sys->country})";
                        ?>
                    </p>

                    <p class="pb-1">
                        <?php
                        $now = date('l g:i a', $currentTime);
                        echo $now;
                        ?>
                    </p>
                    
                    <img src="https://openweathermap.org/img/wn/<?php echo $data->weather[0]->icon; ?>@2x.png" alt="">

                    <p class="pt-1 font-semibold">
                            <?php
                            $desc = ucwords($data->weather[0]->description);
                            echo $desc;
                            ?>
                        </span>
                    </p>

                    <p class="py-1 font-semibold text-slate-50">
                        <span class="font-normal text-lg">
                            <?php
                            $temp_min = $data->main->temp_min;
                            echo $temp_min;
                            ?>
                        </span>
                         - 
                    
                        <span class="font-normal text-lg">
                            <?php
                            $temp_max = $data->main->temp_max;
                            echo $temp_max;
                            ?>
                        </span> &#8451;
                    </p>

                    
                    <div class="mt-4 lg:mt-8">
                        <form action="/" method="post">
                            <div>
                            <input type="text" name="city" placeholder="Enter a City e.g. Berlin" class="w-full py-1 px-2 rounded bg-slate-50 text-slate-800 font-medium text-sm placeholder-slate-900">
                            </div>
                            
                            <button type="submit" class="p-1.5 mt-3 px-2.5 text-center rounded-md bg-amber-500 text-green-950 font-bold">
                                Load Weather
                            </button>
                        </form>
                    </div>

                </div>
                
                <div class="mt-3 px-4 py-3 pb-5 lg:p-6 grid justify-items-end col-span-1 text-white opacity-85 rounded-lg">
                    
                    <p class="py-2 pb-6 font-light text-3xl italic">
                        <span class="text-7xl">
                            <?php
                            $temp = $data->main->feels_like;
                            echo $temp;
                            ?></span>&#8451;
                    </p>
                    
                    <p class="mt-4 lg:mt-8 py-1.5 font-medium text-sm italic"> 
                        Humidity <span class="font-normal text-lg pl-4">
                            <?php
                            $humidity = $data->main->humidity;
                            echo $humidity;
                            ?> RH
                        </span>
                    </p>
                
                    <p class="py-1.5 font-medium text-sm italic">  
                        Atmospheric Pressure: 
                        <span class="font-normal text-lg pl-4">
                            <?php
                            $pressure = $data->main->pressure;
                            echo $pressure;
                            ?> hPa
                        </span>
                    </p>
                    
                    <p class="py-1.5 font-medium text-sm italic">
                        Wind speed: 
                        <span class="font-normal text-lg pl-4">
                            <?php
                            $wind = $data->wind->speed;
                            echo $wind;
                            ?> m/s
                        </span>
                    </p>
                
                    <p class="py-1.5 font-medium text-sm">
                        Clouds: 
                        <span class="font-normal text-lg pl-4">
                            <?php
                            $cld = $data->clouds->all;
                            echo $cld;
                            ?> %
                        </span>
                    </p>
                
                    <p class="py-1.5 font-medium text-sm italic">
                    Visibility: 
                        <span class="font-normal text-lg pl-4">
                            <?php
                            $vis = $data->visibility;
                            echo $vis;
                            ?> m
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>