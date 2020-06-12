all: demo
demo: libjieba.a
	gcc -o demo demo.c -L./ -ljieba -lstdc++ -lm
libjieba.a:
	g++ -o jieba.so -c -DLOGGING_LEVEL=LL_WARNING -I./deps/ lib/jieba.cpp
	ar rs libjieba.a jieba.so
clean:
	rm -f *.a *.o demo
