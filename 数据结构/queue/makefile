# makefile 使用说明：https://www.cnblogs.com/owlman/p/5514724.html
# 1. makefile中变量采用$(变量)的方法使用
# 2. $(shell cmd) 执行cmd的shell命令，并将结果返回

# 由c++语言编写的程序需使用 g++ 编译器编译 
cc = g++ 

# 指定生成的目标可执行文件
prom = main

# 编译添加的参数
params = -Wall -O2 -g -fmessage-length=0

# 找出当前目录及子目录所有的.h文件
h_files = $(shell find ./ -name "*.h")

# 找出当前目录及子目录所有的.cpp文件
cpp_files = $(shell find ./ -name "*.cpp")

# 找出当前目录及子目录所有的.o文件
o_files = $(cpp_files:%.cpp=%.o)

# 指定prom的依赖, 根据obj生成prom (*.o)
$(prom): $(prom).cpp
	$(cc) $(params) -o $(prom) $(prom).cpp

# 指定o_files(*.o)的依赖 *.cpp 
# %.o: %.cpp
# 	$(cc) $(params) -o $@ $<	

clean:
	rm -rf $(o_files) $(prom)