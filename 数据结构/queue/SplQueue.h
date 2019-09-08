/**
 * 环形队列
 */

#ifndef SPL_QUEUE_H
#define SPL_QUEUE_H


/**
 * 从队列头部取出，从队列尾部插入
 */

class SplQueue {
    protected: 
        /**
         * 队列数组指针
         */
        int *pQueue;

        /**
         * 当前队列元素个数
         */
        int len;

        /**
         * 队列数组容量
         */
        int capacity;

        /**
         * 当前队列头部位置
         */
        int iHead;

        /**
         * 当前队列尾部位置
         */
        int iTail;

    public:
        /**
         * 创建队列
         */
        SplQueue(int capacity);

        /**
         * 销毁队列
         */
        ~SplQueue();

        /**
         * 队列长度
         */
        int length();

        /**
         * 清空队列
         */
        void clearQueue();

        /**
         * 当前队列是否为空
         */
        bool isEmpty();

        /**
         * 当前队列是否已满
         */
        bool isFull();

        /**
         * 入队
         */
        bool enQueue(int element);

        /**
         * 出队, 通过引用获取返回元素
         */
        bool deQueue(int &element);

        /**
         * 遍历队列
         */
        void traverse();

};

#endif